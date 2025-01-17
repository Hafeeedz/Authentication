<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    function category(Request $request){
        $validator = Validator::make($request->all(),[
           
            'category_name'=>'required',
            
        ]);
        if ($validator->fails()) 
        {
            return response()->json([
                'status'=>false,
                'message'=>$validator -> errors()
            ]);
        }
        $data = [
            
            'category_name'=>$request->get('category_name'),
        ];
        try {
            $insert = Category::create($data);
            return Response()->json (["status"=>true,'message'=>'Data berhasil ditambahkan']);
        } catch (Exception $e) {
            return Response()->json(["status"=>false,'message'=>$e]);
        }
    }
    function getCategory() {
        try{
            $category = Category::get();
            return response()->json([
                'status'=>true,
                'message'=>'berhasil load kategori',
                'data'=>$category,
            ]);
        } catch(Exception $e){
            return response()->json([
                'status'=>false,
                'message'=>'gagal load kategori '. $e,
            ]);
        }
    }
    function getDetailCategory($id) {
        try{
            $kategori = Category::where('id',$id)->first();
            return response()->json([
                'status'=>true,
                'message'=>'berhasil load data detail kategori',
                'data'=>$kategori,
            ]);
        } catch(Exception $e){
            return response()->json([
                'status'=>false,
                'message'=>'gagal load data detail kategori '. $e,
            ]);
        }
    }
    function update_category($id, Request $request) {
        $validator = Validator::make($request->all(), [
            'category_name'=>'required',
            
            
        ]);


        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
            ]);
        }
        $data = [
            'category_name'=>$request->get('category_name'),
            
            
        ];
        try {
            $update = Category::where('id',$id)->update($data);
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
    function hapus_category($id) {
        try{
            Category::where('id',$id)->delete();
            return Response()->json([
                "status"=>true,
                'message'=>'Data berhasil dihapus'
            ]);
        } catch(Exception $e){
            return Response()->json([
                "status"=>false,
                'message'=>'gagal hapus kategori. '.$e,
            ]);
        }
    }
}