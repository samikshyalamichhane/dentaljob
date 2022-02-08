<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FrontJobList extends Component
{
    public $jobs;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($jobs = null)
    {
        $this->jobs = $jobs;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.front-job-list');
    }
}
