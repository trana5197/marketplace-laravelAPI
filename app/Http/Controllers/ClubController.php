<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    public function createClub(Request $req)
    {
        $club = Club::create([
            'name' => $req->name,
            'email' => $req->email,
        ]);

        return response()->json([
            'status'=>200,
            'message'=>'Club Created Successfully'
        ]);

    }

    public function getClubs()
    {
        $clubs = Club::all();
        return response()->json([
            'status'=>200,
            'data'=>$clubs
        ]);
    }

    public function getUsersClub($email)
    {
        $userClubs = Club::where("email",$email)->get();
        return response()->json([
            'status'=>200,
            'data'=>$userClubs
        ]);
    }

    public function delClub($id)
    {
        $delUser = Club::find($id);
        $delUser->delete();

      
        return response()->json([
            "status"=>200,
            "message"=>"Record Has Been Deleted"
        ]);
       
    }
}