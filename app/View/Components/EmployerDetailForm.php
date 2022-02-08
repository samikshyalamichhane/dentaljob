<?php

namespace App\View\Components;

use Illuminate\View\Component;

class EmployerDetailForm extends Component
{
    public $employer;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($employer)
    {
        $this->employer = $employer;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.employer-detail-form');
    }
}
