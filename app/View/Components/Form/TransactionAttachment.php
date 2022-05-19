<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class TransactionAttachment extends Component
{
    public int $maxElement;

    /**
     * Create a new component instance.
     *
     * @param int $maxElement
     */
    public function __construct($maxElement = 10)
    {
        //
        $this->maxElement = $maxElement;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.transaction-attachment');
    }
}
