<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Libraries\Hash;
class LoginController extends BaseController
{   
    public function __construct(){
        helper(['url','form','html']);
    }
    public function index()
    {   
        return view('auth/login');
    }
    public function register(){
        return view('auth/register');
    }
    public function save_register(){
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
            return view('auth/register',['validation'=>$this->validator]);
        }else{
            $data  = [
                'user_name' => $this->request->getPost('user_name'),
                'full_name' => $this->request->getPost('full_name'),
                'email' => $this->request->getPost('email'),
                'password' => Hash::make($this->request->getPost('password')),
            ];
            $model= new UserModel();
            $query = $model->insert($data);
            if(!$query){
                return redirect()->back()->with('status','Failed');
            }
            return redirect()->to('admin/login')->with('msg_success','Đăng kí thành công!');
        }
    }
    public function check(){
        $validation = $this->validate([
            'user_name '=>[
                'rules' => 'required|is_not_unique[users.user_name]',
                'errors' =>[
                    'required'=> 'Không được để trống {field} !',
                    'is_not_unique'=> '{field} chưa tồn tại !',
                ]
                ],
                'password' =>[
                    'rules'  => 'required',
                    'errors' =>[
                        'required'=> 'Không được để trống {field} !',
                    'is_not_unique'=> '{field} chưa tồn tại !',

                    ]
                ]
        ]);
        if(!$validation){
            return view('auth/login',['validation' =>$this->validator]);
        }else{
            $user_name = $this->request->getPost('user_name');
            $password = $this->request->getPost('password');
            $user = new UserModel();
            $user_info = $user->where('user_name',$user_name)->first();
            $getRoleUser = $user_info['role'];
            if($getRoleUser==1){
                $check_password = Hash::check($password,$user_info['password']);
                if(!$check_password){
                    
                    return redirect()->to('admin/login')->withInput();
                }else{
                    $session = session();
                    $user_id = $user_info['id'];
                    $session->set('logged',$user_id);
                    return redirect()->to('admin/dashboard');
                } 
           
            }else{
                session()->setFlashdata('msg_failed','Bạn không có quyền đăng nhập');
                return redirect()->to('admin/login');
            }
            
        }
    }
    public function logout(){
        if(session()->has('logged')){
            session()->remove('logged');
            return redirect()->to('admin/login?access=out')->with('msg','Đăng xuất thành công');
        }
        
    }
}
