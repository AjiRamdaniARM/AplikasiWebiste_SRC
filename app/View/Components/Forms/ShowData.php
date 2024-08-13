<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class ShowData extends Component
{
    public $label;

    public $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $value)
    {
        $this->label = $label;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.show-data');
    }
}
