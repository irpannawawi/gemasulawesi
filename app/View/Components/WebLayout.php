<?php

namespace Web\View\Components;

use Illuminate\Support\Carbon;
use Illuminate\View\Component;
use Illuminate\View\View;

class WebLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $date = Carbon::now()->isoFormat('dddd, D MMMM Y');
        return view('layouts.Web', $date);
    }
}
