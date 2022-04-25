<?php

namespace Database\Seeders\PaymentMethod;

use App\Models\PaymentMethod\Account;
use App\Models\PaymentMethod\PaymentMethod;
use App\Models\PaymentMethod\Type;
use App\Supports\PaymentMethodSupport;
use Database\Factories\PaymentMethod\AccountFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class PaymentMethodAccountSeeder extends Seeder
{
    public $COUNT = 15;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->prepareDependency();
        $accounts = Account::factory()->count($this->COUNT)->make();
        foreach ($accounts as $account){
            try {
                $account->save();
            }catch (\Exception $exception){

            }
        }

    }

    private function getRandomPaymentMethod(Collection $paymentMethodTypeList)
    {

        /** @var  $paymentMethodType Type */
        $paymentMethodType = $paymentMethodTypeList->random(1)->first();
        /** @var Collection $paymentMethodList */
        $paymentMethodList = $paymentMethodType->paymentMethods;
        return $paymentMethodList->random(1)->first();
    }

    private function prepareDependency()
    {
        $paymentMethodQuery = PaymentMethodSupport::getPaymentMethodTypeQuery();

        if ($paymentMethodQuery->count() === 0) {
            $this->call([
                TypeSeeder::class,
                PaymentMethodAccountSeeder::class
            ]);
        }
    }
}