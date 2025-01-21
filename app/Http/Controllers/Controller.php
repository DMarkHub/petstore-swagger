<?php

namespace App\Http\Controllers;

use App\DTO\ApiResponseDTO;

abstract class Controller
{
    public $view = [
        'message'
    ];

    protected array $resultComponentData = [];
    protected array $resultComponentActions = [];
    protected ?ApiResponseDTO $message = null;
    protected array $form = [];

    public function getViewData(): array
    {
        return [
            'resultComponentData' => $this->resultComponentData,
            'resultComponentActions' => $this->resultComponentActions,
            'message' => $this->message,
            'form' => $this->form,
        ];
    }

    public function addResultComponentData(array $input): void
    {
        $this->resultComponentData[] = $input;
    }

    public function addResultComponentAction(array $input): void
    {
        $this->resultComponentActions[] = $input;
    }

    public function addResultComponentActions(array $input): void
    {
        $this->resultComponentActions = array_merge($this->resultComponentActions, $input);
    }

    public function setMessage(ApiResponseDTO $message): void
    {
        $this->message = $message;
    }

    public function addFormItem(string $key, mixed $value): void
    {
        $this->form[$key] = $value;
    }
}
