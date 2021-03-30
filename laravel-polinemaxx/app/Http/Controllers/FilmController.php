<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Film;

class FilmController extends Controller
{
   //fungsi index digunakan untuk menampilkan semua data user
   public function index(){
    $data = Film::all();

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
public function getId($id_film)
{
    $data = Film::where('id_film',$id_film)->get();

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
    $film = new Film();
    $film->nama = $request->nama;
    $film->gambar = $request->gambar;
    $film->dimensi = $request->dimensi;
    $film->usia = $request->usia;
    $film->durasi = $request->durasi;
    $film->kategori = $request->kategori;
    $film->produser = $request->produser;
    $film->direktor = $request->direktor;
    $film->penulis = $request->penulis;
    $film->cast = $request->cast;
    $film->deskripsi = $request->deskripsi;


    if($film->save()){
        $res['message'] = "Data berhasil ditambah!";
        $res['value'] = "$film";
        return response($res);
    }
}
public function update(Request $request, $id_film)
{
    $nama = $request->nama;
    $gambar = $request->gambar;
    $dimensi = $request->dimensi;
    $usia = $request->usia;
    $durasi = $request->durasi;
    $kategori = $request->kategori;
    $produser = $request->produser;
    $direktor = $request->direktor;
    $penulis = $request->penulis;
    $cast = $request->cast;
    $deskripsi = $request->deskripsi;

    $film = Film::find($id_film);
    $film->nama = $nama;
    $film->gambar = $gambar;
    $film->dimensi = $dimensi;
    $film->usia = $usia;
    $film->durasi = $durasi;
    $film->kategori = $kategori;
    $film->produser = $produser;
    $film->direktor = $direktor;
    $film->penulis = $penulis;
    $film->cast = $cast;
    $film->deskripsi = $deskripsi;

    if($film->save()){
        $res['message'] = "Data berhasil diubah!";
        $res['value'] = "$film";
        return response($res);
    }
    else{
        $res['message'] = "Gagal!";
        return response($res);
    }
}
public function delete($id_film){
    $film = Film::where('id_film',$id_film);

    if($film->delete()){
        $res['message'] = "Data berhasil dihapus!";
        return response($res);
    }
    else{
        $res['message'] = "Gagal!";
        return response($res);
    }
} 
}
