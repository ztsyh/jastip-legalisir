<?php

namespace App\View\Components\Api\RajaOngkir\Geo;

use Illuminate\View\Component;

class Province extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.api.raja-ongkir.geo.province');
    }
}
