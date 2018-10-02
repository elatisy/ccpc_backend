<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Service\UserService;

class UserController extends Controller
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var UserService
     */
    private $userService;

    public function __construct(User $user, UserService $user_service)
    {
        $this->user = $user;
        $this->userService = $user_service;
    }

    public function login(request $request)
    {
        return response([
            'result'    => $this->userService->loginCheck($request->all())
        ]);
    }

    public function alterPassword(request $request)
    {
        return response([
            'result'    => $this->userService->alterPassword($request->header('token'), $request->newPassword)
        ]);
    }

}
