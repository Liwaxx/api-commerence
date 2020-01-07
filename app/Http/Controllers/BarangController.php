<?php

namespace App\Http\Controllers;

use App\Barang;
use Illuminate\Http\Request;
use App\Helper\responses;

class BarangController extends Controller
{
    public function add(Request $request){
        $helper = new responses();

        $nama_barang = $request->nama_barang;
        $jumlah = $request->jumlah;
        $harga_barang = $request->harga_barang;
        $file = $request->file('image');

        $filename = 'imageBarang'.time().'.'.$file->getClientOriginalExtension();

        $file->move('image_barang/', $filename);

        $data = Barang::create([
            'nama_barang' => $nama_barang,
            'stock' => $jumlah,
            'harga_barang' => $harga_barang,
            'image' => $filename
        ]);

        if ($data->save()){
            return $helper->responseMessage('Berhasil tambah barang');
        }else{
            return $helper->responseData('Gagal tambah barang');
        }
    }
//    public function edit($id){
//        $helper = new responses();
//
//        $data = Barang::where('id_barang',$id)->first();
//
//        return $helper->responseMessageData('Berhasil get data',$data);
//    }
    public function update(Request $request,$id){
        $helper = new responses();

        $nama_barang = $request->nama_barang;
        $jumlah = $request->jumlah;
        $harga_barang = $request->harga_barang;
        $file = $request->file('image');


        if (empty($file)){
            Barang::where('id_barang',$id)->update([
                'nama_barang' => $nama_barang,
                'stock' => $jumlah,
                'harga_barang' => $harga_barang
            ]);
            return $helper->responseMessage('Berhasil update barang!');
        }else{

            $data = Barang::where('id_barang',$id)->first();

            $nama_gambar = $data->image;

            $path = public_path('image_barang/'.$nama_gambar);

            if (file_exists($path)){
                unlink($path);
            }

            $filename = 'imageBarang'.time().'.'.$file->getClientOriginalExtension();

            $file->move('image_barang/', $filename);

            Barang::where('id_barang',$id)->update([
                'nama_barang' => $nama_barang,
                'stock' => $jumlah,
                'harga_barang' => $harga_barang,
                'image' => $filename
            ]);

            return $helper->responseMessage('Berhasil update barang!');
        }
    }
    public function delete($id){
        $helper =  new responses();

        $data = Barang::where('id_barang',$id)->first();

        $nama_gambar = $data->image;
        $path = public_path('image_barang/'.$nama_gambar);

        unlink($path);
        Barang::where('id_barang',$id)->delete();

        return $helper->responseMessage('Berhasil hapus barang');
    }

    public function getAll(){
        $helper = new responses();
        $data =  Barang::all();
        return $helper->responseMessageData('Berhasil get data',$data);
    }

}
