<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Theater;

class TheaterController extends Controller
{
    public function index(){
        $data = Theater::all();

        if(count($data) > 0){
            $res['message'] = "Success!";
            $res['values'] = $data;
            return response($res);
        }
        else{
            $res['message'] = "Kosong!";
            return response($res);
        }
    }
    public function getId($id)
    {
        $data = Theater::where('id',$id)->get();

        if(count($data) > 0){
            $res['message'] = "Success!";
            $res['values'] = $data;
            return response($res);
        }
        else{
            $res['message'] = "Gagal!";
            return response($res);
        }
    }
    public function create(Request $request)
    {
        $theater = new Theater();
        $theater->nama = $request->nama;
        $theater->alamat = $request->alamat;
        $theater->telp = $request->telp;
        $theater->bioskop = $request->bioskop;

        if($theater->save()){
            $res['message'] = "Data berhasil ditambah!";
            $res['value'] = "$theater";
            return response($res);
        }
    }
    public function update(Request $request, $id)
    {
        $nama = $request->nama;
        $alamat = $request->alamat;
        $telp = $request->telp;
        $bioskop = $request->bioskop;

        $theater = Theater::find($id);
        $theater->nama = $nama;
        $theater->alamat = $alamat;
        $theater->telp = $telp;
        $theater->bioskop = $bioskop;

        if($theater->save()){
            $res['message'] = "Data berhasil diubah!";
            $res['value'] = "$theater";
            return response($res);
        }
        else{
            $res['message'] = "Gagal!";
            return response($res);
        }
    }
    public function delete($id){
        $theater = Theater::where('id',$id);

        if($theater->delete()){
            $res['message'] = "Data berhasil dihapus!";
            return response($res);
        }
        else{
            $res['message'] = "Gagal!";
            return response($res);
        }
    }
}
