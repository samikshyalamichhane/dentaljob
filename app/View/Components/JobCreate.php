<?php

namespace App\View\Components;

use Illuminate\View\Component;

class JobCreate extends Component
{
    public $employers;
    public $jobCategories;
    public $detail;
    public $pubDate;
    public $deadDate;
    public $startDate;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($jobCategories, $employers = null, $detail = null, $pubDate = null, $deadDate = null, $startDate = null)
    {
        $this->employers = $employers;
        $this->jobCategories = $jobCategories;
        $this->detail = $detail;
        $this->pubDate = $pubDate;
        $this->deadDate = $deadDate;
        $this->startDate = $startDate;
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.job-create');
    }
}
