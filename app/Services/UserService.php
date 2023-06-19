<?php

namespace App\Services;

use Exception;

class UserService
{
    public function login(UserLoginRequest $request)
    {   
        $credentials = $request->only(['email', 'password']);

        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized2'], 401);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token){
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
           // 'expires_in' => Auth::factory()->getTTL() * 60
        ], 200);
    }

    public function register(Request $request){
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        try {

            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $plainPassword = $request->input('password');
            $user->password = app('hash')->make($plainPassword);

            $user->save();

            //return successful response
            return response()->json(['user' => $user, 'message' => 'CREATED'], 201);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'User Registration Failed!'], 409);
        }
    }

    public function find(Request $request) {
        try {
            $dadosJson = $request->all();
            if ($dadosJson['filtro'] != 'todos') {
                $filtro = $dadosJson['filtro'];
                $valorFiltro = $dadosJson['valorFiltro'];
                $client =  User::where($filtro, 'like', "%$valorFiltro%")->get();
            }else{
                $client =  User::query()->select('id', 'name')->get();
            }
            return json_encode($client);
        }catch(\Exception $e) {
            $retorno['result'] = $e;
            return response()->json($retorno);
        }  
    }

}