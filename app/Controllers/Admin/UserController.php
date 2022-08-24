<?php

namespace App\Controllers\Admin;
use App\Models\UserModel;
use App\Controllers\BaseController;
use App\Libraries\Hash;
class UserController extends BaseController
{
    public function __construct(){
        helper(['url','form']);
    }

    
    public function index()
    {
        $model = new UserModel();
        $loggedUser = session()->get('logged');
        if($loggedUser==true){
            $userInfo= $model->find($loggedUser);
            $data['userInfo']=$userInfo;
            $data['users'] = $model->findAll();
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
                        'required' => 'Không được để trống {field} !',
                        'is_unique'=> '{field} đã tồn tại !',
                        'min_length' =>'tối thiểu 6 kí tự'
                    ],
                ],
                'email' => [
                    'rules'  => 'required|is_unique[users.email]|valid_email',
                    'errors' => [
                        'required' => 'Không được để trống {field} !',
                        'is_unique'=> '{field} đã tồn tại !',
                    ],
                ],'full_name' => [
                    'rules'  => 'required|',
                    'errors' => [
                        'required' => 'Không được để trống {field} !',
                    ],
                ],'role' => [
                    'rules'  => 'required|',
                    'errors' => [
                        'required' => 'Không được để trống {field} !',
                    ],
                ],'password' => [
                    'rules'  => 'required|min_length[6]',
                    'errors' => [
                        'required' => 'Không được để trống {field} !',
                        'is_unique'=> '{field} đã tồn tại !',
                        'min_length' =>'{field} tối thiểu 6 kí tự'
                    ],
                ],'cpassword' => [
                    'rules'  => 'required|min_length[6]|matches[password]',
                    'errors' => [
                        'required' => 'Không được để trống {field} !',
                        'matches' =>'mật khẩu không giống !',
                        'min_length' =>'tối thiểu 6 kí tự'
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
            //             'required' => 'Không được để trống {field} !',
            //             'is_unique'=> '{field} đã tồn tại !',
            //             'min_length' =>'tối thiểu 6 kí tự'
            //         ],
            //     ],
            //     'email' => [
            //         'rules'  => 'required|is_unique[users.email]|valid_email',
            //         'errors' => [
            //             'required' => 'Không được để trống {field} !',
            //             'is_unique'=> '{field} đã tồn tại !',
            //         ],
            //     ],'full_name' => [
            //         'rules'  => 'required|',
            //         'errors' => [
            //             'required' => 'Không được để trống {field} !',
            //         ],
            //     ],'password' => [
            //         'rules'  => 'required|min_length[6]',
            //         'errors' => [
            //             'required' => 'Không được để trống {field} !',
            //             'is_unique'=> '{field} đã tồn tại !',
            //             'min_length' =>'{field} tối thiểu 6 kí tự'
            //         ],
            //     ],'cpassword' => [
            //         'rules'  => 'required|min_length[6]|matches[password]',
            //         'errors' => [
            //             'required' => 'Không được để trống {field} !',
            //             'matches' =>'mật khẩu không giống !',
            //             'min_length' =>'tối thiểu 6 kí tự'
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
        session()->setFlashdata('msg_failed','Bạn phải đăng nhập');

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
                return redirect()->back()->with('status','Xoá không thành công');
                }
                if($checkRoleUser){
                    $users->delete($id);
                    return redirect()->back()->with('status','Xoá thành công');
                }
                return redirect()->back()->with('failed','Vui lòng liên hệ admin để được cấp quyền');
            }
            session()->setFlashdata('msg_failed','Bạn phải đăng nhập');
            return redirect()->to('admin/login');
    }
}
