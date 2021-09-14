<?php

namespace App\View\Components\Components\Markup;

use Illuminate\View\Component;

class Collapse extends Component
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

		$this->class = $class ?? '';
		$this->bodyClass = $bodyClass ?? '';
	}

	/**
	 * Get the view / contents that represent the component.
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view( 'components.components.markup.collapse' );
	}
}