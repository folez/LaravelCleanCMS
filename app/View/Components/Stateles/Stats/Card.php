<?php

namespace App\View\Components\Stateles\Stats;

use Illuminate\View\Component;

class Card extends Component
{
    public $oldValue;

    public $newValue;

    public $percent;

    private $arrowDown  = "fa-long-arrow-down";
    private $arrowUp    = "fa-long-arrow-up";

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(int $newValue = null, int $oldValue = null)
    {
        $this->newValue = $newValue;
        $this->oldValue = $oldValue;

        $this->percent = $this->calculatePercentage();
    }

    public function RenderPercent()
    {
        if($this->percent < 0){
            return <<<HTML
            <span class="percent-data">
                <span class="percent" style="color: #5ADA1E"></span>
                <span class="arrow">
                    <i class="fal {$this->}"></i>
                </span>
            </span>
HTML;

        }
    }

    public function calculatePercentage()
    {
        return number_format( ( ( $this->newValue-$this->oldValue ) / $this->newValue * 100 ), '1' );
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.stateles.stats.card');
    }
}
