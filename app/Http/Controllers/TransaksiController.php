<?php

namespace App\Http\Controllers;

use App\Models\TransaksiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class TransaksiController extends Controller
{
    public function createTranksasi(Request $req){
        $validate = Validator::make($req->all(),[
            'tgl_transaksi'=>'required',
            'id_user'=>'required',
            'id_meja'=>'required',
            'nama_pelanggan'=>'required',
            'status'=>'required'
        ]);
        if($validate->fails()){
            return response()->json($validate->errors()->toJson());
        }
        $create = TransaksiModel::create([
            'tgl_transaksi'=>$req->tgl_transaksi,
            'id_user'=>$req->id_user,
            'id_meja'=>$req->id_meja,
            'nama_pelanggan'=>$req->nama_pelanggan,
            'status'=>$req->status
        ]);
        if($create){
            return response()->json(['status'=>true, 'message'=>'sukses menambahkan transaksi.']);
        }else{
            return response()->json(['status'=>false, 'message'=>'gagal menambahkan transaksi.']);
        }
    }
    public function update_transaksi(Request $req, $id)
    {
        $validator = Validator::make($req->all(),[
            'tgl_transaksi'=>'required',
            'id_user'=>'required',
            'id_meja'=>'required',
            'nama_pelanggan'=>'required',
            'status'=>'required'
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors()->toJson());
        }
        $ubah=TransaksiModel::where('id_transaksi',$id)->update([
            'tgl_transaksi' =>$req->get('tgl_transaksi'),
            'id_user' =>$req->get('id_user'),
            'id_meja' =>$req->get('id_meja'),
            'nama_pelanggan' =>$req->get('nama_pelanggan'),
            'status' =>$req->get('status')
        ]);
        if($ubah){
            return Response()->json(['status'=>true, 'message' =>'sukses mengubah transaksi']);
        } else {
            return Response()->json(['status'=>false, 'message' =>'gagal mengubah transaksi']);
        }
    }
    public function getdetailtransaksi($id){
        $dt=TransaksiModel::where('id_transaksi',$id)->first();
        return Response()->json($dt);
    }
    public function destroytransaksi($id)
    {
        $hapus=TransaksiModel::where('id_transaksi',$id)->delete();
        if($hapus){
            return Response()->json(['status'=>true, 'message'=>'sukses hapus Transaksi']);
        } else {
            return Response()->json(['status'=>false, 'message'=>'gagal hapus Transaksi']);
        }
    }
    public function getTransaksi(){
        $get_transaksi = TransaksiModel::get();
        return response()->json($get_transaksi);
    
    }
    public function createDetailTransaction(Request $req){
        $validate = Validator::make($req->all(),[
            'id_transaksi'=>'required',
            'id_menu'=>'required',
            'harga'=>'required',
            'qty'=>'required'
        ]);
        if($validate->fails()){
            return response()->json($validate->errors()->toJson());
        }
        $create = DetailTrxModel::create($req->all(),[
            'tgl_transaksi'=>$req->tgl_transaksi,
            'id_transaksi'=>$req->id_transaksi,
            'id_menu'=>$req->id_menu,
            'harga'=>$req->harga,
            'qty'=>$req->qty
        ]);
        if($create){
            return response()->json(['status'=>true]);
        }else{
            return response()->json(['status'=>false]);
        }
    }
        public function updateLunas(Request $req, $id){
            $updateLunas = TransaksiModel::where('id_transaksi',$id)
                            ->update(['status'=>$req->status_lunas]);
            if($updateLunas){
                return response()->json(['status'=>true, 'message'=>'Lunas!']);
            }else{
                return response()->json(['status'=>false, 'message'=>'Gagal update status.']);
            }
        }
        public function destroy_transaksi($id)
        {
            $hapus= TransaksiModel::where('id_transaksi',$id)->delete();
            if($hapus){
                return Response()->json(['status'=>true, 'message'=>'sukses hapus Transaksi']);
            } else {
                return Response()->json(['status'=>false, 'message'=>'gagal hapus Transaksi']);
            }
        }
        public function get_transaksi(){
            $get_transaksi = TransaksiModel::get();
            return response()->json($get_transaksi);
        }
}