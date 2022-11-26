<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function createAccount(Request $req)
    {
        $validator = Validator::make($req->all(),[
        'firstName' => 'required',
        'lastName' => 'required',
        'email' => 'required',
        'password' => 'required',
        'profile' => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'message'=>'Bad Request'
            ]);
        }
        else
        {
            $user = User::create([
                'firstName' => $req->firstName,
                'lastName' => $req->lastName,
                'email' => $req->email,
                'password' => Hash::make($req->password),
                'profile' => $req->profile,
            ]);
            
            // $token = $user->createToken($user->email.'_Token')->plainTextToken;

            return response()->json([
                'status'=>200,
                // 'userName'=>$user->firstName,
                'message'=>'Account Created Successfully'
            ]);
        }
    }

    public function signIn(Request $req)
    {
        $validator = Validator::make($req->all(),[
        'email' => 'required',
        'password' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json([
            'status'=>400,
            'message'=>'Bad Request'
            ]);
        }

        $user = User::where('email',$req->email)->first();

        // $tokenResult = $user->createToken('authToken')->plainTextToken;
        $token = $user->createToken($user->email.'_Token')->plainTextToken;


        return response()->json([
        'status'=>200,
        'firstName'=>$user->firstName,
        'lastName'=>$user->lastName,
        'email'=>$user->email,
        'profile'=>$user->profile,
        'token'=>$token
        ]);
    }

    public function signOut(Request $req)
    {
        $req->user()->currentAccessToken()->delete();

        return response()->json([
        'status'=>200,
        'message'=>'Token deleted successfully'
        ]);
    }

    public function getUsers()
    {
        $users = User::all();
        return response()->json([
            'status'=>200,
            'data'=>$users
        ]);
    }

    public function getUsersProfile($profile)
    {
        $userProfile = User::where("profile",$profile)->get();
        return response()->json([
            'status'=>200,
            'data'=>$userProfile
        ]);
    }

    public function delUsersProfile($id)
    {
        $delUser = User::find($id);
        $delUser->delete();

      
        return response()->json([
            "status"=>200,
            "message"=>"Record Has Been Deleted"
        ]);
       
    }
}