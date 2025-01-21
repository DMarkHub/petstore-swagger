<?php

namespace App\View\Components;

use App\DTO\ApiResponseDTO;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MessageComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ApiResponseDTO $data
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if ($this->data->type !== 'success') {
            $this->data->type = 'danger';
        }

        return view('components.message-component', [
            'data' => $this->data->printable()
        ]);
    }
}
