<?php

namespace App\View\Components\Modal;

use Illuminate\View\Component;

class ButtonTriger extends Component
{
    public $modalId;

    public $modalName;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($modalId, $modalName)
    {
        $this->modalId = $modalId;
        $this->modalName = $modalName;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal.button-triger');
    }
}
