<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(Request $request){
        $take = $request->query('take', 10);
        $skip = $request->query('skip', 0);
        $search = $request->query('search');

        $query = User::query();
        if ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        }

        $total = $query->count();
        $users = $query->skip($skip)->take($take)->get();
        // $users = User::all();
        return response()->json(['code' => 200 ,'message' => 'All data users ','data' => $users], 200);
    }

    public function store(Request $request){
        $this->validateRequest($request);
        $user = User::create([
                    'email' => $request->get('email'),
                    'name' => $request->get('name'),
                    'role' => $request->get('role'),
                    'password'=> Hash::make($request->get('password'))
                ]);
        return response()->json(['code' => 201 ,'message' => "The user with with id {$user->id} has been created",'data' => $user], 201);
    }

    public function show($user_id){

        $user = User::find($user_id);
        if(!$user){
            return response()->json(['code'=>404,'message' => "The user with {$user_id} doesn't exist" ,'data'=>[]], 404);
        }
        return response()->json(['code'=>200,'message'=>'Show data user with id '.$user->id , 'data' => $user], 200);
    }

    public function update(Request $request, $user_id){
        $user = User::find($user_id);
        if(!$user){
            return response()->json(['message' => "The user with {$user_id} doesn't exist"], 404);
        }
        $this->validateRequest($request);
        $user->email        = $request->get('email');
        $user->password     = Hash::make($request->get('password'));
        $user->save();
        return response()->json(['code'=>200,'message'=> "The user with with id {$user->id} has been updated",'data' => $user], 200);
    }

    public function destroy($user_id){

        $user = User::find($user_id);
        if(!$user){
            return response()->json(['message' => "The user with {$user_id} doesn't exist"], 404);
        }
        $user->delete();
        return response()->json(['code'=>200,'message'=> "The user with with id {$user_id} has been deleted",'data' => $user], 200);
    }

    public function validateRequest(Request $request){
        $rules = [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,user'
        ];

        $message = [
            'email.required' => "email tidak boleh kosong !",
            'password.required' => "password tidak boleh kosong !",
            'role.required' => "role tidak boleh kosong !",
        ];
        $this->validate($request, $rules,$message);
    }

    //
}
