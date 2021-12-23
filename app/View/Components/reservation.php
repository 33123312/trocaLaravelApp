<?php

namespace App\View\Components;

use Illuminate\View\Component;

class reservation extends Component
{
    public $res;
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public function __construct($res)
    {
        $this->res = $res;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.reservation');
    }
}
