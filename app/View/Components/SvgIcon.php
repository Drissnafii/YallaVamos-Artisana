<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SvgIcon extends Component
{
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function render()
    {
        $svgPath = resource_path("svg/{$this->name}.svg");
        
        if (file_exists($svgPath)) {
            return file_get_contents($svgPath);
        }
        
        return '';
    }
}
