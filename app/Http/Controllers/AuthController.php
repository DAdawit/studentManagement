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
    public function allUsers(){
        $users=User::where('role','user')->paginate();
//        $users=User::paginate(3);
        return response($users);
    }

    public function searchUser($searchName){
        return User::where('name','like','%'.$searchName.'%')->get();

    }

    public function getUser(User $user){
        return response($user);
    }
    public function register(Request $request){
        $fields =$request -> validate([
            'name'=>'required|string',
            'email'=>'required|string|unique:users,email',
            'password'=> 'required|string|confirmed',
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
          $user=User::where('email',$fields['email'])->first();
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
        auth('sanctum')->user()->tokens()->delete();
    }

    public function verifyToken(Request $request){
            $user=$request->user('sanctum');
            if($request->user('sanctum')== null){
                return response('unauthorized',401);
            }else
         return $user;
    }

    public function resetPassword(Request $request){
        $user=User::find($request->id);
        $user->password=bcrypt($request->new_password);
        $user->update();
        return response()->json(['success' => 'password changed !'], 201);
    }

    public function changePassword(Request $request){
        $request->validate([
            'old_password'=>'required',
            'new_password'=>'required'
        ]);
           $user=User::find($request->id);
            if($user){
                if(Hash::check($request['old_password'],$user->password)){
                    $user->password=bcrypt($request->new_password);
                    $user->update();
                    return 'password changed';
                }else{
                    return response()->json(['error' => 'old password not match !'], 401);
                }
            }
                return 'user not fuound';
    }
}