<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class HomeController extends BaseController
{
    public function index()
    {   
            $userModel  = new UserModel();
            $request = service('request');
		    $searchData = $request->getGet();
            $search = "";
            if(isset($searchData)&& isset($searchData['search'])){
                $search = $searchData['search'];
            }
            $loggedUser = session()->get('logged');
            $userInfo= $userModel->find($loggedUser);
            $data=[
                'userInfo'=>$userInfo,
                'list'=>$userModel->paginate(1,'list'),
                'pager'=>$userModel->pager,
            ];
            return view('Admin/dashboard',$data);
        
        }
        
   public function search(){

   }
    
}
