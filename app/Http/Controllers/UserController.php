<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Helper\responses;

class UserController extends Controller
{
    public function deleteUser($id){
        $helper = new responses();

        if(User::where('id_user',$id)->count() < 1){
            return $helper->responseError('user tidak ada');
        }

        User::where('id_user',$id)->delete();

        return $helper->responseMessage('Berhasil hapus user');
    }

    public function getAll(){
        $helper = new responses();
        $data = User::all();
        return $helper->responseMessageData('Berhasil get data',$data);
    }
}
