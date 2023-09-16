<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProdukController extends Controller
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
        $query = Produk::query();
        if ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        }
        $produks = $query->skip($skip)->take($take)->get();

        return response()->json(['code' => 200 ,'message' => 'All data produk ','data' => $produks], 200);
    }

    public function store(Request $request){
        $this->validateRequest($request);
        $produks = Produk::create([
                    'name' => $request->get('name'),
                    'user_id' => $request->get('user_id'),
                ]);
        return response()->json(['code' => 201 ,'message' => "The produks with with id {$produks->id} has been created",'data' => $produks], 201);
    }

    public function show($produk_id){

        $produks = Produk::find($produk_id);
        if(!$produks){
            return response()->json(['message' => "The produks with {$produk_id} doesn't exist"], 404);
        }
        return response()->json(['code'=>200,'message'=>'Show data produks with id '.$produks->id , 'data' => $produks], 200);
    }

    public function update(Request $request, $produk_id){
        $produks = Produk::find($produk_id);
        if(!$produks){
            return response()->json(['message' => "The produks with {$produk_id} doesn't exist"], 404);
        }
        $this->validateRequest($request);
        $produks->name        = $request->get('name');
        $produks->user_id     = $request->get('user_id');
        $produks->save();
        return response()->json(['code'=>200,'message'=> "The produks with with id {$produks->id} has been updated",'data' => $produks], 200);
    }

    public function destroy($produk_id){
        $produks = Produk::find($produk_id);
        if(!$produks){
            return response()->json(['message' => "The produks with {$produk_id} doesn't exist"], 404);
        }
        $produks->delete();
        return response()->json(['code'=>200,'message'=> "The produks with with id {$produk_id} has been deleted",'data' => $produks], 200);
    }

    public function validateRequest(Request $request){
        $rules = [
            'name' => 'required',
            'user_id' => 'required'
        ];

        $this->validate($request, $rules);
    }

    //
}
