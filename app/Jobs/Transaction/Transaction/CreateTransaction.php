<?php

namespace App\Jobs\Transaction\Transaction;

use App\Events\Transaction\Transaction\TransactionCreated;
use App\Models\Geo\City;
use App\Models\Geo\District;
use App\Models\Geo\Province;
use App\Models\Transaction\Transaction;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CreateTransaction
{
    use Dispatchable, SerializesModels;

    protected array $attributes;
    public \App\Models\Transaction\Transaction $transaction;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($attributes = [], $status = Transaction::TRANSACTION_STATUS_CREATED)
    {
        $attributes = array_merge(['status' => $status], $attributes);
        $this->attributes = Validator::make($attributes, [
            'province_id' => ['required', 'filled', 'exists:' . Province::getTableName() . ',province_id'],
            'city_id' => ['required', 'filled', 'exists:' . City::getTableName() . ',city_id'],
            'district_id' => ['required', 'filled', 'exists:' . District::getTableName() . ',district_id'],
            'zip_code' => ['required', 'filled'],
            'address' => ['required', 'filled'],
            'partner_shipment' => ['filled'],
            'file' => ['required', 'filled'],
            'partner_shipment_code' => ['nullable'],
            'partner_shipment_service' => ['nullable'],
            'partner_shipment_price' => ['nullable'],
            'partner_shipment_etd' => ['nullable'],
            'status' => ['required', Rule::in(Transaction::getAvailableStatus())]
        ])->validate();
        unset($this->attributes['partner_shipment'], $this->attributes['file']);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // TODO: Assign Into Existing User
        $this->attributes['user_id'] = 1;
        $this->transaction = new \App\Models\Transaction\Transaction($this->attributes);
        $this->transaction->save();

        if ($this->transaction->exists) {
            \event(new TransactionCreated($this->transaction));
        }
    }
}
