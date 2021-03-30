<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;

class AdminController extends Controller
{
    //fungsi index digunakan untuk menampilkan semua data user
    public function index(){
        $data = Admin::all();

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
        $data = Admin::where('id',$id)->get();

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
        $admin = new Admin();
        $admin->nama = $request->nama;
        $admin->username = $request->username;
        $admin->password = $request->password;

        if($admin->save()){
            $res['message'] = "Data berhasil ditambah!";
            $res['value'] = "$admin";
            return response($res);
        }
    }
    public function update(Request $request, $id)
    {
        $nama = $request->nama;
        $username = $request->username;
        $password = $request->password;

        $admin = Admin::find($id);
        $admin->nama = $nama;
        $admin->username = $username;
        $admin->password = $password;

        if($admin->save()){
            $res['message'] = "Data berhasil diubah!";
            $res['value'] = "$admin";
            return response($res);
        }
        else{
            $res['message'] = "Gagal!";
            return response($res);
        }
    }
    public function delete($id){
        $admin = Admin::where('id',$id);

        if($admin->delete()){
            $res['message'] = "Data berhasil dihapus!";
            return response($res);
        }
        else{
            $res['message'] = "Gagal!";
            return response($res);
        }
    }
}
