<?php

namespace App\Http\Controllers;

use App\Enum\OrderStatus;
use App\Exceptions\AppException;
use App\Factories\ApiResponseDTOFactory;
use App\Services\StoreService;
use Illuminate\Http\Request;
use Illuminate\View\View;

use function Laravel\Prompts\error;

class StoreController extends Controller
{
    public function __construct(
        private StoreService $storeService,
        private ApiResponseDTOFactory $apiResponseDTOFactory
    ) {

    }

    public function showInventory(): View
    {
        $inventory = $this->storeService->getInventory();

        $this->addResultComponentData($inventory);

        return view('store.inventory', $this->getViewData());
    }

    public function showOrder(Request $request): View
    {
        if ($request->isMethod('POST')) {
            $validated = $request->validate([
                'id' => 'required|integer'
            ]);

            try {
                $dto = $this->storeService->getOrder((int) $validated['id']);

                $this->addResultComponentData($dto->printable());
                $this->addResultComponentActions($this->getActions($dto->id));
            } catch (AppException $e) {
                $this->setMessage($e->apiResponseDTO);
            }
        }

        return view('store.order', $this->getViewData());
    }

    public function createOrder(Request $request): View
    {
        $this->addFormItem('availiableOrderStatus', OrderStatus::values());

        if ($request->isMethod('POST')) {
            try {
                $validated = $request->validate([
                    'petId' => 'required|integer',
                    'quantity' => 'required|integer',
                    'shipDate' => 'required|string',
                    'status' => 'required|string',
                    'complete' => 'string'
                ]);

                $order = $this->storeService->createOrder($validated);

                $this->addResultComponentData($order->printable());
                $this->setMessage($this->apiResponseDTOFactory->createSuccessMessage(sprintf('Order id: %s created', $order->id)));
            } catch (AppException $e) {
                $this->setMessage($e->apiResponseDTO);
            }
        }

        return view('store.order-create', $this->getViewData());
    }

    public function deleteOrder(Request $request): View
    {
        $orderId = $request->query('id');

        if ($orderId) {
            $this->addFormItem('id', $orderId);
        }

        if ($request->isMethod('POST')) {
            $validated = $request->validate([
                'id' => 'required|integer'
            ]);

            try {
                $orderId = (int) $validated['id'];
                $result = $this->storeService->deleteOrder($orderId);

                $this->setMessage($this->apiResponseDTOFactory->createSuccessMessage(sprintf('Order id: %s deleted', $orderId)));
            } catch (AppException $e) {
                $this->setMessage($e->apiResponseDTO);
            }
        }

        return view('store.order-delete', $this->getViewData());
    }

    private function getActions(int $id): array
    {
        return [
            'delete' => route('store.order.delete', ['id' => $id])
        ];
    }
}
