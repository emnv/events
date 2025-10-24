<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EventDrawer extends Component
{
    public $event;

    public $eventCode;

    public $mode;

    /**
     * Create a new component instance.
     */
    public function __construct($event = null, $eventCode = null, $mode = 'create')
    {
        $this->event = $event;
        $this->eventCode = $eventCode;
        $this->mode = $mode;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.event-drawer');
    }
}
