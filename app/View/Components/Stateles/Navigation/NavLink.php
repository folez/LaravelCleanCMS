<?php

namespace App\View\Components\Stateles\Navigation;

use Illuminate\View\Component;

class NavLink extends Component
{
	public $href;
	public $class;
	public $match;
	public $activeMarkup;
	public $active;

	CONST PREFIX    = "prefix";
	CONST ALL       = "all";

    /**
     * Create a new component instance.
     *
     * @return void
     */
	public function __construct(string $href = '#', string $class = '', string $match = self::PREFIX)
	{
		$this->class = $class;
		$this->href = url($href);
		$this->match = $match;
		$this->active = $this->matchRoute();
	}

	public function matchRoute() : bool
	{
		$route = url(\Route::getCurrentRoute()->compiled->getStaticPrefix());
		if( $this->match == self::ALL )
			return ( $route == $this->href );

		if( $this->match == self::PREFIX )
			return (strpos($route,$this->href) === 0);

		return false;
	}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.stateles.navigation.nav-link');
    }
}
