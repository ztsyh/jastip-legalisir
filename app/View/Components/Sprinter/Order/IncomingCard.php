<?php

namespace App\View\Components\Sprinter\Order;

use App\Models\Transaction\Transaction;
use Illuminate\View\Component;

class IncomingCard extends Component
{
    public Transaction $transaction;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Transaction $transaction)
    {

        $this->transaction = $transaction;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sprinter.order.incoming-card');
    }
}