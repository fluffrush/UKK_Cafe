<?php

namespace App\Http\Controllers;

use App\Models\MenuModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use File;

class MenuController extends Controller
{
    public function createMenu(Request $req){
        $validate = Validator::make($req->all(),[
            'nama_menu'=>'required',
            'jenis'=>'required',
            'deskripsi'=>'required',
            'gambar'=>'required',
            'harga'=>'required'
        ]);
        if($validate->fails()){
            return response()->json($validate->errors()->toJson());
        }
        $name = $req->file('gambar')->getClientOriginalName(); 
        $path = $req->file('gambar')->store('public/foto_produk');
        $save = new File;
        $save->name = $name;
        $save->path = $path;
        $create = MenuModel::create([
            'nama_menu'=>$req->nama_menu,
            'jenis'=>$req->jenis,
            'deskripsi'=>$req->deskripsi,
            'gambar'=>$name,
            'harga'=>$req->harga
        ]);
        if($create){
            return response()->json(['status'=>true,  'message'=>'Yes! Your data was added successfully.']);
        }else{
            return response()->json(['status'=>false, 'message'=>'Ups, sorry there is something wrong.']);
        }
    }

    public function update_menu(Request $req, $id)
{
    $validator = Validator::make($req->all(),[
        'nama_menu'=>'required',
        'jenis'=>'required',
        'deskripsi'=>'required',
        'gambar'=>'required',
        'harga'=>'required'
    ]);
    if($validator->fails()){
        return Response()->json($validator->errors()->toJson());
    }
    $ubah=MenuModel::where('id_menu',$id)->update([
        'nama_menu' =>$req->get('nama_menu'),
        'jenis' =>$req->get('jenis'),
        'deskripsi' =>$req->get('deskripsi'),
        'gambar' =>$req->get('gambar'),
        'harga' =>$req->get('harga')
    ]);
    if($ubah){
        return Response()->json(['status'=>true, 'message' =>'sukses mengubah menu']);
    } else {
        return Response()->json(['status'=>false, 'message' =>'gagal mengubah menu']);
    }
}

public function getdetailmenu($id)
{
    if(auth('admin_api')->user()->role=="admin"){
        $dt=MenuModel::where('id_menu',$id)->first();
        return Response()->json($dt);
    } else {
        return Response()->json(['status'=>'unauthorized']);
    }
    
}
public function destroymenu($id)
{
    $hapus=MenuModel::where('id_menu',$id)->delete();
    if($hapus){
        return Response()->json(['status'=>true, 'message'=>'sukses hapus menu']);
    } else {
        return Response()->json(['status'=>false, 'message'=>'gagal hapus menu']);
    }
    }
public function getMenu(){
    $get_menu = MenuModel::get();
    return response()->json($get_menu);
}
}



