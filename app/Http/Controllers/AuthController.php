<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\DB;


class AuthController extends Controller
{
    public function register(Request $request){
        $fields =$request -> validate([
            'name'=>'required|string',
            'email'=>'required|string|unique:users,email',
            'password'=> 'required|string|confirmed'
        ]);

        $user = User::create([
            'name'=>$fields['name'],
            'email'=>$fields['email'],
            'password'=>bcrypt($fields['password'])
        ]);

        $token = $user->createToken('token')->plainTextToken;


        $response = [
            'user'=> $user,
            'token'=> $token
        ];

        return response($response,201);
    }


    public function login(Request $request){
            $fields = $request -> validate([
                'email'=>'required|string',
                'password'=> 'required|string'
            ]);
        // $users = DB::table('users')->where('email',$fields['email'])->get();
          $user=User::where('email',$fields['email'])->first();
            
            // return $user;

            if(!$user || !Hash::check($fields['password'],$user->password)){
                return response([
                    'message'=> 'user name and password not match!'
                ],401);
            }

            $token = $user->createToken('token')->plainTextToken;


            $response = [
                'user'=> $user,
                'token'=> $token
            ];

            return response($response,201);
        }

    public function logout(){
        auth()->user()->tokens()->delete();
    }

    public function verifyToken(Request $request){
            // return $hashedToken;
            $user=$request->user('sanctum');
            if($request->user('sanctum')== null){
                return response('unauthorized',401);
            }else
         return $user;
    }

    }