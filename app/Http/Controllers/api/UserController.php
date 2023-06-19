<?php

namespace App\Http\api\Controllers;
//use Illuminate\Support\Facades\Validator;

use App\Http\Requests\User\UserLoginRequest;
use Illuminate\Support\Facades\Hash;

use Auth;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller{
    private UserService $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }
    /**
     * Get a JWT via given credentials.
     *
     * @param  Request  $request
     * @return Response
     */
    public function login(UserLoginRequest $request){
        $this->service->login($request);
    }

    public function register(Request $request){
        $this->service->register($request);
    }

    public function find(Request $request) {
        $this->service->find($request);  
    }

}
