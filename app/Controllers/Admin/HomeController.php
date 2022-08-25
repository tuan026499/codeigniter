<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class HomeController extends BaseController
{
    public function index()
    {
        $userModel  = new UserModel();
        $loggedUser = session()->get('logged');
        $userInfo = $userModel->find($loggedUser);
        $data = [
            'userInfo' => $userInfo,
        ];
        return view('Admin/dashboard', $data);
    }

    
}
