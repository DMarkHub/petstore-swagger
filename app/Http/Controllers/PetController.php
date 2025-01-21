<?php

namespace App\Http\Controllers;

use App\DTO\PetDTO;
use App\Enum\PetStatus;
use App\Exceptions\AppException;
use App\Factories\ApiResponseDTOFactory;
use App\Services\PetService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PetController extends Controller
{
    public function __construct(
        private PetService $petService,
        private ApiResponseDTOFactory $apiResponseDTOFactory
    ) {

    }

    public function show(Request $request): View
    {
        if ($request->isMethod('POST')) {
            $validated = $request->validate([
                'id' => 'required|integer',
            ]);

            try {
                $pet = $this->petService->getPetById((int) $validated['id']);

                if (!$pet) {
                    throw new AppException($this->apiResponseDTOFactory->create(0, 'error', 'Probably corrupted swagger response'));
                }

                $this->addResultComponentData($pet->printable());
                $this->addResultComponentActions($this->getActions($pet->id));
            } catch (AppException $e) {
                $this->setMessage($e->apiResponseDTO);
            }
        }

        return view('pet.show', $this->getViewData());
    }

    public function create(Request $request): View
    {
        $this->addFormItem('availiablePetStatus', PetStatus::values());
        $this->addFormItem('availiablePetTags', ['Tag 1', 'Tag 2', 'Tag 3']);
        $this->addFormItem('status', 'undefined');

        if ($request->isMethod('POST')) {
            $validated = $request->validate([
                'category' => 'required|string',
                'name' => 'required|string',
                'photoUrls' => 'required|string',
                'tags' => 'required|string',
                'status' => 'required|string',
            ]);

            try {
                $dto = $this->petService->create($validated);

                $this->addResultComponentData($dto->printable());
                $this->addResultComponentActions($this->getActions($dto->id));
                $this->setMessage($this->apiResponseDTOFactory->createSuccessMessage(sprintf('Pet id: %s created', $dto->id)));
            } catch (AppException $e) {
                $this->setMessage($e->apiResponseDTO);
            }
        }

        return view('pet.create', $this->getViewData());
    }

    public function update(Request $request, int $id): View
    {
        $this->addFormItem('availiablePetStatus', PetStatus::values());
        $this->addFormItem('availiablePetTags', ['Tag 1', 'Tag 2', 'Tag 3']);
        $this->addFormItem('status', 'undefined');

        try {
            $pet = $this->petService->getPetById($id);
            $this->prepareForm($pet);

            if ($request->isMethod('POST')) {
                $validated = $request->validate([
                    'id' => 'required|integer',
                    'category' => 'required|string',
                    'name' => 'required|string',
                    'photoUrls' => 'required|string',
                    'tags' => 'required|string',
                    'status' => 'required|string',
                ]);

                $updated = $this->petService->update($validated);
                $this->setMessage($this->apiResponseDTOFactory->createSuccessMessage(sprintf('Pet id: %s updated', $updated->id)));

                $this->prepareForm($updated);
            }
        } catch (AppException $e) {
            $this->setMessage($e->apiResponseDTO);
        }

        return view('pet.create', $this->getViewData());
    }

    private function getActions(int $id): array
    {
        return [
            'update' => route('pet.update', ['id' => $id]),
            'delete' => route('pet.delete', ['id' => $id])
        ];
    }

    private function prepareForm(PetDTO $pet): void
    {
        $this->addFormItem('id', $pet->id);
        $this->addFormItem('category', $pet->category->name);
        $this->addFormItem('name', $pet->name);
        $this->addFormItem('photoUrls', implode(', ', $pet->photoUrls));
        $this->addFormItem('tags', implode(', ', array_map(function ($element) {
            return $element->name ?? '';
        }, $pet->tags)));
        $this->addFormItem('status', $pet->status);

    }
}
