<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Tooltip extends Component
{
    public function __construct(
        public string $text,
        public string $bg_color = 'bg-brand-navy',
        public string $text_color = 'text-white',
        public string $class = '',
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.tooltip');
    }
}
