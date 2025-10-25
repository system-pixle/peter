<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DashboardCard extends Component
{
    public $title;
    public $link;
    public $color;

    public function __construct($title, $link = '#', $color = 'blue')
    {
        $this->title = $title;
        $this->link = $link;
        $this->color = $color;
    }

    public function render()
    {
        return view('components.dashboard-card');
    }
}
