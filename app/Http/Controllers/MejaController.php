<?php

namespace App\Http\Controllers;

use App\Models\MejaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class MejaController extends Controller
{
    public function createMeja(Request $req){
        $validate = Validator::make($req->all(),[
            'nomor_meja'=>'required'
        ]);
        if($validate->fails()){
            return response()->json($validate->errors()->toJson());
        }
        $create = MejaModel::create([
            'nomor_meja'=>$req->nomor_meja
        ]);
        if($create){
            return response()->json(['status'=>true, 'message'=>'sukses menambahkan nomor meja.']);
        }else{
            return response()->json(['status'=>false, 'message'=>'gagal menambahkan nomor meja.']);
    }  
}
public function update_meja(Request $req, $id)
{
    $validator = Validator::make($req->all(),[
        'nomor_meja'=>'required',
    ]);
    if($validator->fails()){
        return Response()->json($validator->errors()->toJson());
    }
    $ubah=MejaModel::where('id_meja',$id)->update([
        'nomor_meja' => $req->get('nomor_meja'),
    ]);
    if($ubah){
        return Response()->json(['status'=>true, 'message' =>'sukses mengubah meja']);
    } else {
        return Response()->json(['status'=>false, 'message' =>'gagal mengubah meja']);
    }
}
public function getdetailmeja($id)
{
    $dt=MejaModel::where('id_meja',$id)->first();
    return Response()->json($dt);
}
public function destroymeja($id)
{
    $hapus=MejaModel::where('id_meja',$id)->delete();
    if($hapus){
        return Response()->json(['status'=>true, 'message'=>'sukses hapus meja']);
    } else {
        return Response()->json(['status'=>false, 'message'=>'gagal hapus meja']);
    }
    }
public function getMeja(){
    $get_meja = MejaModel::get();
    return response()->json($get_meja);
}

}
