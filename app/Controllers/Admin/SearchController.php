<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class SearchController extends BaseController
{
    public function search()
    {
        $userModel  = new UserModel();
        $request = service('request');
        $searchData = $request->getGet();
        $search = "";
        if (isset($searchData) && isset($searchData['search'])) {
            $search = $searchData['search'];
        }
        if ($search == '') {
            $paginateData = $userModel->paginate(1);
        } else {
            $paginateData = $userModel->select('*')->orLike('full_name', $search)->orLike('email', $search)->orLike('role', $search)->paginate(5);
        }
        $data = [
            'users'=>$paginateData,
            'pager' => $userModel->pager,
            'search' => $search,
        ];
        return view('admin/page/users/index', $data);
    }
}
