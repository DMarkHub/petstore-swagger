<?php

namespace App\Http\Controllers;

use App\Exceptions\AppException;
use App\Factories\ApiResponseDTOFactory;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(
        private UserService $userService,
        private ApiResponseDTOFactory $apiResponseDTOFactory
    ) {

    }

    public function login(Request $request)
    {
        if ($request->isMethod('POST')) {
            $validated = $request->validate([
                'username' => 'required|string',
                'password' => 'required|string',
            ]);

            try {
                $user = $this->userService->getUserByUsername($validated['username']);

                if ($user->password !== $validated['password']) {
                    throw new AppException($this->apiResponseDTOFactory->create(0, 'error', 'Incorect user password'));
                }

                $message = $this->userService->loginUser($validated['username'], $validated['password']);

                if ($message->code !== 200) {
                    throw new AppException($this->apiResponseDTOFactory->create(0, 'error', 'User login failuer'));
                }

                $this->userService->login($user);

                $this->setMessage($this->apiResponseDTOFactory->create(0, 'success', sprintf('User id: %s logged', $user->id)));
            } catch (AppException $e) {
                $this->setMessage($e->apiResponseDTO);
            }
        }

        return view('user.login', $this->getViewData());
    }

    public function logout(): RedirectResponse
    {
        $this->userService->logout();

        return redirect()->route('dashboard');
    }

    public function show(Request $request): View
    {
        if ($request->isMethod('POST')) {
            $validated = $request->validate([
                'username' => 'required|string',
            ]);

            try {
                $dto = $this->userService->getUserByUsername($validated['username']);
                $user = $dto->printable();

                $this->addResultComponentData($user);
                $this->addResultComponentActions([
                    'update' => route('user.update', ['username' => $dto->username]),
                    'delete' => route('user.delete', ['username' => $dto->username]),
                ]);
            } catch (AppException $e) {
                $this->setMessage($e->apiResponseDTO);
            }
        }

        return view('user.show', $this->getViewData());
    }

    public function create(Request $request): View
    {
        if ($request->isMethod('POST')) {
            $validated = $request->validate([
                'username' => 'required|string',
                'firstName' => 'required|string',
                'lastName' => 'required|string',
                'email' => 'required|string',
                'password' => 'required|string',
                'phone' => 'required|string',
                'userStatus' => 'required|int',
            ]);

            try {
                $user = $this->userService->createUser($validated);

                $this->setMessage($this->apiResponseDTOFactory->createSuccessMessage(sprintf('User id: %s created', $user->message)));
            } catch (AppException $e) {
                $this->setMessage($e->apiResponseDTO);
            }
        }

        return view('user.create', $this->getViewData());
    }

    public function createMultiple(Request $request): View
    {
        if ($request->isMethod('POST')) {
            try {
                $validated = $request->validate([
                    'body' => 'required|string'
                ]);

                $body = json_decode($validated['body'], true);
                $users = $this->userService->createUsers($body);

                $this->setMessage($this->apiResponseDTOFactory->createSuccessMessage(sprintf('User id: %s created', $user->message)));
            } catch (AppException $e) {
                $this->setMessage($e->apiResponseDTO);
            }
        }

        return view('user.create-multiple', $this->getViewData());
    }

    public function update(Request $request, string $username): RedirectResponse|View
    {
        $message = null;
        $form = [];

        try {
            $user = $this->userService->getUserByUsername($username);

            if ($request->isMethod('POST')) {
                $validated = $request->validate([
                    'id' => 'required|int',
                    'username' => 'required|string',
                    'firstName' => 'required|string',
                    'lastName' => 'required|string',
                    'email' => 'required|string',
                    'password' => 'required|string',
                    'phone' => 'required|string',
                    'userStatus' => 'required|int',
                ]);

                $update = $this->userService->updateUser($username, $validated);

                if ($update->code === 200) {
                    return redirect()->route('user.update', ['username' => $validated['username']]);
                }
            }

            $form = $user->printable();
        } catch (AppException $e) {
            $message = $e->apiResponseDTO->printable();
        }

        return view('user.create', [
            'message' => $message,
            'form' => $form
        ]);
    }

    public function delete(Request $request, string $username): View
    {
        $this->addFormItem('username', $username);

        try {
            $user = $this->userService->getUserByUsername($username);
            $delete = $this->userService->deleteUser($username);

            if ($delete->code === 200) {
                $this->setMessage($this->apiResponseDTOFactory->createSuccessMessage(sprintf('User: %s deleted', $username)));
            }
        } catch (AppException $e) {
            $this->setMessage($e->apiResponseDTO);
        }

        return view('user.delete', $this->getViewData());
    }
}
