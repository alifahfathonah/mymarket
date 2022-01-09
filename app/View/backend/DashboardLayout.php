<?php

namespace App\View\Components\backend;

use Illuminate\View\Component;

class DashboardLayout extends Component
{
    public $title;
    public $tagSubMenu;

    public function __construct($title,$tagSubMenu)
    {
        $this->title = $title;
        $this->tagSubMenu = $tagSubMenu;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.backend.dashboard-layout');
    }
}
