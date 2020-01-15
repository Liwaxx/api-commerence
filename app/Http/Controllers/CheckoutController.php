<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use App\Checkout;
use App\Helper\responses;

class CheckoutController extends Controller
{
    public function newTransaksi(Request $req){
        $helper = new responses();

         Transaksi::create([
            'id_user' => $req->id_user
        ]);

        //from object to array this will make payloads for transaksi
        $data = $req->data;
        $id_transaksi = Transaksi::max('id_transaksi');

        //make payloads
        foreach ($data as $data){
            $checkout[] = [
                'id_transaksi' => $id_transaksi,
                'id_barang' => $data['id_barang'],
                'jumlah_barang' => $data['jumlah_barang'],
                'harga_beli' => $data['harga_beli'],
            ];
        }
        //push payloads
        if(Checkout::insert($checkout)){
            return $helper->responseMessage('Berhasil checkout barang silahkan bayar!!');
        }
        else{
            return $helper->responseError('Gagal checkout barang');
        }
    }
}
