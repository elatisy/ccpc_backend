<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    private $user_table;

    public function __construct() {
        $this->user_table = DB::table('user');
    }

    public function login(Request $request) {
        $recv = $request->all();

        $info_need = [
            'account', 'password'
        ];
        foreach ($info_need as $info){
            if(!isset($recv[$info])){
                return response()->json([
                    'code'  => -1
                ]);
            }
        }
        $user = $this->user_table->where('account', '=', $recv['account'])->first();
        if($user != null) {
            $password_hash = $user->password;
            if(password_verify($recv['password'], $password_hash)){
                return response()->json([
                    'code'  => 0,
                    'token' => $user->token
                ]);
            }
        }

        return response()->json([
            'code'  => -1
        ]);
    }
}
