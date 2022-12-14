<?php

namespace App\Controllers\Admin;
use App\Models\UserModel;
use App\Controllers\BaseController;
use App\Libraries\Hash;
use CodeIgniter\Config\Services;

class UserController extends BaseController
{
    public function __construct(){
        helper(['url','form']);
    }

    
    public function index()
    {
        $pager = Services::pager();
        $model = new UserModel();
        $loggedUser = session()->get('logged');
        if($loggedUser==true){
            $userInfo= $model->find($loggedUser);
            $data['userInfo']=$userInfo;
            $data=[
                'users'=>$model->paginate(2,'group1'),
                'pager'=>$model->pager,
                'currentPage' => $model->pager->getCurrentPage('group1'), // The current page number
                'totalPages'  => $model->pager->getPageCount('group1'),
            ];
            return view('Admin/page/users/index',$data);
        }
       return redirect()->to('admin/login');
    }

    public function create_user(){
        $model = new UserModel();
        $loggedUser = session()->get('logged');
        if($loggedUser==true){
            $userInfo= $model->find($loggedUser);
            $data['userInfo']=$userInfo;
            $data['users'] = $model->findAll();
            return view('Admin/page/users/create',$data);
        }
        // if($this->request->getMethod() == 'post'){
        //     // $rules = [
        //     //     'user_name'=>'required|is_unique(users.user_name)|min_length[6]|max_length[12]',
        //     //     'email'=>'required|is_unique(users.email)|valid_email',
        //     //     'full_name'=>'required',
        //     //     'password'=>'required|min_length[6]',
        //     // ];
        //     // $validation = \Config\Services::validation();
        //     $data = [
        //         'user_name'=>$this->request->getVar('user_name'),
        //         'password' => md5($this->request->getVar("password")),
        //         'full_name'=>$this->request->getVar('full_name'),
        //         'role'=>$this->request->getVar('role'),
        //         'email'=>$this->request->getVar('email'),
        //         // $post = $this->request->getVar();
        //     ];
        //         $model->save($data);
        //         return view('Admin/page/users/create',["validation"=>$this->validator]);
        //     }else{  
        //         $data['validation'] = $this->validator;
        // }
    }
    public function save_user(){
        $model = new UserModel();
        $loggedUser = session()->get('logged');
        if($loggedUser==true){
            $userInfo= $model->find($loggedUser);
            $data['userInfo']=$userInfo;
            $validation = $this->validate([
                'user_name' => [
                    'rules'  => 'required|is_unique[users.user_name]|min_length[5]',
                    'errors' => [
                        'required' => 'Kh??ng ???????c ????? tr???ng {field} !',
                        'is_unique'=> '{field} ???? t???n t???i !',
                        'min_length' =>'t???i thi???u 6 k?? t???'
                    ],
                ],
                'email' => [
                    'rules'  => 'required|is_unique[users.email]|valid_email',
                    'errors' => [
                        'required' => 'Kh??ng ???????c ????? tr???ng {field} !',
                        'is_unique'=> '{field} ???? t???n t???i !',
                    ],
                ],'full_name' => [
                    'rules'  => 'required|',
                    'errors' => [
                        'required' => 'Kh??ng ???????c ????? tr???ng {field} !',
                    ],
                ],'role' => [
                    'rules'  => 'required|',
                    'errors' => [
                        'required' => 'Kh??ng ???????c ????? tr???ng {field} !',
                    ],
                ],'password' => [
                    'rules'  => 'required|min_length[6]',
                    'errors' => [
                        'required' => 'Kh??ng ???????c ????? tr???ng {field} !',
                        'is_unique'=> '{field} ???? t???n t???i !',
                        'min_length' =>'{field} t???i thi???u 6 k?? t???'
                    ],
                ],'cpassword' => [
                    'rules'  => 'required|min_length[6]|matches[password]',
                    'errors' => [
                        'required' => 'Kh??ng ???????c ????? tr???ng {field} !',
                        'matches' =>'m???t kh???u kh??ng gi???ng !',
                        'min_length' =>'t???i thi???u 6 k?? t???'
                    ],
                ],
    
            ]);
            if(!$validation){
                return view('admin/page/users/create',['validation'=>$this->validator]);
            }else{
                $data1 = [
                        'user_name'=>$this->request->getVar('user_name'),
                        'password' => Hash::make($this->request->getVar("password")),
                        'full_name'=>$this->request->getVar('full_name'),
                        'role'=>$this->request->getVar('role'),
                        'email'=>$this->request->getVar('email'),
                        // $post = $this->request->getVar();
                    ];
                        $model->insert($data1);
                        return redirect()->to('/admin/users/user-create');

            }
        }
            // $validation = $this->validate([
            //     'user_name' => [
            //         'rules'  => 'required|is_unique[users.user_name]|min_length[5]',
            //         'errors' => [
            //             'required' => 'Kh??ng ???????c ????? tr???ng {field} !',
            //             'is_unique'=> '{field} ???? t???n t???i !',
            //             'min_length' =>'t???i thi???u 6 k?? t???'
            //         ],
            //     ],
            //     'email' => [
            //         'rules'  => 'required|is_unique[users.email]|valid_email',
            //         'errors' => [
            //             'required' => 'Kh??ng ???????c ????? tr???ng {field} !',
            //             'is_unique'=> '{field} ???? t???n t???i !',
            //         ],
            //     ],'full_name' => [
            //         'rules'  => 'required|',
            //         'errors' => [
            //             'required' => 'Kh??ng ???????c ????? tr???ng {field} !',
            //         ],
            //     ],'password' => [
            //         'rules'  => 'required|min_length[6]',
            //         'errors' => [
            //             'required' => 'Kh??ng ???????c ????? tr???ng {field} !',
            //             'is_unique'=> '{field} ???? t???n t???i !',
            //             'min_length' =>'{field} t???i thi???u 6 k?? t???'
            //         ],
            //     ],'cpassword' => [
            //         'rules'  => 'required|min_length[6]|matches[password]',
            //         'errors' => [
            //             'required' => 'Kh??ng ???????c ????? tr???ng {field} !',
            //             'matches' =>'m???t kh???u kh??ng gi???ng !',
            //             'min_length' =>'t???i thi???u 6 k?? t???'
            //         ],
            //     ],
    
            // ]);
            // if(!$validation){
            //     return view('admin/page/users/create',['validation'=>$this->validator]);
            
            // }else{
            //     echo "success";
            // }
                // $data = [
                //     'user_name'=>$this->request->getVar('user_name'),
                //     'password' => Hash::make($this->request->getVar("password")),
                //     'full_name'=>$this->request->getVar('full_name'),
                //     'role'=>$this->request->getVar('role'),
                //     'email'=>$this->request->getVar('email'),
                //     // $post = $this->request->getVar();
                // ];
                //     $model= new UserModel();
                //     $model->save($data);
                //     return redirect()->to('admin/user-list');
            // }
            // if($this->request->getMethod() == 'post'){
                // $rules = [
                //     'user_name'=>'required|is_unique(users.user_name)|min_length[6]|max_length[12]',
                //     'email'=>'required|is_unique(users.email)|valid_email',
                //     'full_name'=>'required',
                //     'password'=>'required|min_length[6]',
                // ];
                // $validation = \Config\Services::validation();
            //     $data = [
            //         'user_name'=>$this->request->getVar('user_name'),
            //         'password' => Hash::make($this->request->getVar("password")),
            //         'full_name'=>$this->request->getVar('full_name'),
            //         'role'=>$this->request->getVar('role'),
            //         'email'=>$this->request->getVar('email'),
            //         // $post = $this->request->getVar();
            //     ];
            //         $model->save($data);
            //         return redirect()->back();
            //         // return view('Admin/page/users/create',["validation"=>$this->validator]);
            //     }else{  
            //         $data['validation'] = $this->validator;
            // }
    }
    public function edit($id){
        $model = new UserModel();
        $loggedUser = session()->get('logged');
        if($loggedUser==true){
            $userInfo= $model->find($loggedUser);
            $data['userInfo']=$userInfo;
            $data['users'] = $model->find($id);
            return view('Admin/page/users/edit',$data);
        }
        session()->setFlashdata('msg_failed','B???n ph???i ????ng nh???p');

       return redirect()->to('admin/login');
        
        
    }
        public function update_user($id){
            $users = new UserModel();
            $users->find($id);
            $data = [
                'user_name'=>$this->request->getVar('user_name'),
                'password' => Hash::make($this->request->getVar("password")),
                'full_name'=>$this->request->getVar('full_name'),
                'role'=>$this->request->getVar('role'),
                'email'=>$this->request->getVar('email'),
            ];
            if(!$data){
                return redirect()->back()->with('status','Failed');
            }
            $users->update($id,$data);
             return redirect()->to(base_url('admin/users/user-list'))->with('status','Success');
    }
    public function delete($id){
        $users = new UserModel();
        $loggedUser = session()->get('logged');
        if($loggedUser==true){
            $userInfo= $users->find($loggedUser);
            $checkRoleUser = $userInfo['role']==1;
            if(!$userInfo){
                return redirect()->back()->with('status','Xo?? kh??ng th??nh c??ng');
                }
                if($checkRoleUser){
                    $users->delete($id);
                    return redirect()->back()->with('status','Xo?? th??nh c??ng');
                }
                return redirect()->back()->with('failed','Vui l??ng li??n h??? admin ????? ???????c c???p quy???n');
            }
            session()->setFlashdata('msg_failed','B???n ph???i ????ng nh???p');
            return redirect()->to('admin/login');
    }
}
