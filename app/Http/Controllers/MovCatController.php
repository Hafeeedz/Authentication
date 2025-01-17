<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class MovCatController extends Controller
{
    function movies(Request $request){
        $validator = Validator::make($request->all(),[
            'title'=>'required',
            'voteaverage'=>'required',
            "overview"=>'required',
            "posterpath"=>'required',
            'category_id'=>'required',
            
        ]);
        if ($validator->fails()) 
        {
            return response()->json([
                'status'=>false,
                'message'=>$validator -> errors()
            ]);
        }
        $data = [
            'title'=>$request->get('title'),
            'voteaverage'=>$request->get('voteaverage'),
            
            'overview'=>$request->get('overview'),
            'posterpath'=>$request->get('posterpath'),
            'category_id'=>$request->get('category_id'),
        ];
        try {
            $insert = Movie::create($data);
            return Response()->json (["status"=>true,'message'=>'Data berhasil ditambahkan']);
        } catch (Exception $e) {
            return Response()->json(["status"=>false,'message'=>$e]);
        }
    }
    function getMovies() {
        try{
            $movie = Movie::get();
            return response()->json([
                'status'=>true,
                'message'=>'berhasil load film',
                'data'=>$movie,
            ]);
        } catch(Exception $e){
            return response()->json([
                'status'=>false,
                'message'=>'gagal load film '. $e,
            ]);
        }
    }
    function getDetailMovies($id) {
        try{
            $movie = Movie::where('id',$id)->first();
            return response()->json([
                'status'=>true,
                'message'=>'berhasil load data detail user',
                'data'=>$movie,
            ]);
        } catch(Exception $e){
            return response()->json([
                'status'=>false,
                'message'=>'gagal load data detail user. '. $e,
            ]);
        }
    }
    function update_movies($id, Request $request) {
        $validator = Validator::make($request->all(), [
            'title'=>'required',
            
            "voteaverage"=>'required',
            "overview"=>'required',
            'posterpath'=>'required',
            'category_id'=>'required',
        ]);


        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
            ]);
        }
        $data = [
            'title'=>$request->get('title'),
            'voteaverage'=>$request->get('voteaverage'),
            'overview'=>$request->get('overview'),
            'posterpath'=>$request->get('posterpath'),
            "category_id"=>$request->get("category_id"),
            
        ];
        try {
            $update = Movie::where('id',$id)->update($data);
            return Response()->json([
                "status"=>true,
                'message'=>'Data berhasil diupdate'
            ]);


        } catch (Exception $e) {
            return Response()->json([
                "status"=>false,
                'message'=>$e
            ]);
        }
    }
    function hapus_movies($id) {
        try{
            Movie::where('id',$id)->delete();
            return Response()->json([
                "status"=>true,
                'message'=>'Data berhasil dihapus'
            ]);
        } catch(Exception $e){
            return Response()->json([
                "status"=>false,
                'message'=>'gagal hapus user. '.$e,
            ]);
        }
    }
}