<?php

namespace App\Exceptions;

use App\Notifications\OrderFilterErrorNotification;
use App\Services\User\UserService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Notification;
use Throwable;

class OrderFilterApplyException extends Exception
{

    private const int CODE = 578;

    private UserService $userService;

    public function __construct(string $message = "", ?Throwable $previous = null)
    {
        parent::__construct($message, self::CODE, $previous);
        $this->userService = app(UserService::class);
    }

    public function report(): void
    {
        $admins = $this->userService->getAdmins();
        Notification::sendNow($admins, new OrderFilterErrorNotification(
            'There is problem in filtering orders'
        ));
    }

    public function render(): JsonResponse
    {
        return response()->json([
            'code' => $this->code,
            'error' => 'Order filter apply failed',
            'message' => $this->getMessage(),
        ], $this->code);
    }

}
