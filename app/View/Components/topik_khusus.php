<?php

namespace App\View\Components;

use Illuminate\View\Component;

class topik_khusus extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public string $topikKhusus,
        )
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
        return view('components.topik_khusus');
    }
}
