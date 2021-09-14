<?php

namespace App\View\Components\Stateles\Markup;

use Illuminate\View\Component;

class Dropdown extends Component
{
    public $id;
    public $class;
    public $bodyClass;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $id = null, string $class = null, string $bodyClass = null)
    {
        $this->id = $id ?? md5(uniqid());
        $this->class = $class;
        $this->bodyClass = $bodyClass;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.stateles.markup.dropdown');
    }
}
