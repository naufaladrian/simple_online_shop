<?php
namespace App\Controllers;
use App\Models\UserModel;

class ProfileController extends BaseController
{
    protected $user;

    function __construct()
    {
        helper('form');
        $this->validation = \Config\Services::validation();
        $this->user = new userModel();
    }

    public function profile()
    {
        return view('v_profile');
    }

    public function edit($id)
    {
        $data = $this->request->getPost();
        $validate = $this->validation->run($data, 'users');
        $errors = $this->validation->getErrors();
        $direction = session()->get('role') == 'admin' ? 'datauser' : 'profile';
        if(!$errors){
            $dataForm = [
                'username' => $this->request->getPost('username'),
                'password' => md5($this->request->getPost('password')),
                'role' => $this->request->getPost('role')
            ];
            $this->user->update($id, $dataForm); 
            return redirect($direction)->with('success','Data Berhasil Diubah');
        }else{
            return redirect($direction)->with('failed',implode("<br>",$errors));
        }
    }


    public function show_all()
    {
        $data['users'] = $this->user->findAll();
        return view('v_datauser', $data);
    }


    public function add_user()
    {
        $data = $this->request->getPost();
        $validate = $this->validation->run($data, 'users');
        $errors = $this->validation->getErrors();
        if(!$errors){
            $dataForm = [
                'username' => $this->request->getPost('username'),
                'password' => md5($this->request->getPost('password')),
                'role' => $this->request->getPost('role')
            ];
            if($this->user->where('username', $dataForm['username'])->first()){
                return redirect('datauser')->with('failed','Username sudah ada');
            }
            $this->user->insert($dataForm); 
            return redirect('datauser')->with('success','Data Berhasil Ditambahkan');
        }else{
            return redirect('datauser')->with('failed',implode("<br>",$errors));
        }
    }
}
