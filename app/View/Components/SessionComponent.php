<?php

namespace App\View\Components;

use App\DTO\UserDTO;
use App\Services\UserService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SessionComponent extends Component
{
    private ?UserDTO $user;
    /**
     * Create a new component instance.
     */
    public function __construct(
        private UserService $userService
    ) {
        $this->user = $this->userService->getUser();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.session-component', ['user' => $this->user]);
    }
}
