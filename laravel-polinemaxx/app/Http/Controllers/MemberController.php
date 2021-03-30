<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;

class MemberController extends Controller
{
    //fungsi index digunakan untuk menampilkan semua data user
    public function index(){
        $data = Member::all();

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
    public function getId($id_user)
    {
        $data = Member::where('id_user',$id_user)->get();

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
        $member = new Member();
        $member->nama = $request->nama;
        $member->alamat = $request->alamat;
        $member->nohp = $request->nohp;
        $member->email = $request->email;
        $member->password = $request->password;

        if($member->save()){
            $res['message'] = "Data berhasil ditambah!";
            $res['value'] = "$member";
            return response($res);
        }
    }
    public function update(Request $request, $id)
    {
        $nama = $request->nama;
        $alamat = $request->alamat;
        $nohp = $request->nohp;
        $email = $request->email;
        $password = $request->password;

        $member = Member::find($id);
        $member->nama = $nama;
        $member->alamat = $alamat;
        $member->nohp = $nohp;
        $member->email = $email;
        $member->password = $password;

        if($member->save()){
            $res['message'] = "Data berhasil diubah!";
            $res['value'] = "$member";
            return response($res);
        }
        else{
            $res['message'] = "Gagal!";
            return response($res);
        }
    }
    public function delete($id_user){
        $member = Member::where('id_user',$id_user);

        if($member->delete()){
            $res['message'] = "Data berhasil dihapus!";
            return response($res);
        }
        else{
            $res['message'] = "Gagal!";
            return response($res);
        }
    }

}
