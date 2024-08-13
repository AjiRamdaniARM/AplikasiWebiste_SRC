<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Modal extends Component
{
    public string $modalId;

    public string $modalTitle;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($modalId, $modalTitle)
    {
        $this->modalId = $modalId;
        $this->modalTitle = $modalTitle;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal');
    }
}
