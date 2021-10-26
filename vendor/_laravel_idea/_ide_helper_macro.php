<?php
/** @noinspection PhpUndefinedClassInspection */
/** @noinspection PhpFullyQualifiedNameUsageInspection */

namespace Illuminate\Contracts\View {
    
    /**
     * @method $this layoutData($data = [])
     * @method $this layout($view, $params = [])
     * @method $this extends($view, $params = [])
     * @method $this section($section)
     * @method $this slot($slot)
     */
    class View {}
}

namespace Illuminate\Http {
    
    /**
     * @method array validate(array $rules, ...$params)
     * @method array validateWithBag(string $errorBag, array $rules, ...$params)
     * @method bool hasValidSignature($absolute = true)
     * @method bool hasValidRelativeSignature()
     */
    class Request {}
}

namespace Illuminate\Testing {
    
    /**
     * @method $this assertSeeLivewire($component)
     * @method $this assertDontSeeLivewire($component)
     */
    class TestResponse {}
    
    /**
     * @method $this assertSeeLivewire($component)
     * @method $this assertDontSeeLivewire($component)
     */
    class TestView {}
}

namespace Illuminate\View {

    use Livewire\WireDirective;
    
    /**
     * @method WireDirective wire($name)
     */
    class ComponentAttributeBag {}
    
    /**
     * @method $this layoutData($data = [])
     * @method $this layout($view, $params = [])
     * @method $this extends($view, $params = [])
     * @method $this section($section)
     * @method $this slot($slot)
     */
    class View {}
}