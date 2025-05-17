<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Muser;

class User extends BaseController
{
    public function index()
    {
        return view('login');                                                                                                   
    }

    public function daftarPengguna(){
        $data=[
            'judulHalaman'=>'<i class="mdi mdi-account-multiple-outline"></i> User List',
            'listPengguna'=>$this->user->orderby('level')->findAll()
        ];
        return view('Pengguna/daftar-pengguna',$data);
    }


    public function tambahPengguna($email=null){
        $data=[
            'judulHalaman'=>'<i class="mdi mdi-account-multiple-outline"></i> '.(isset($email) ? 'Edit User' : 'Form User'),
            'bio'=>(isset($email) ? 'Please edit user data in the form below.' : 'Please enter user data in the form below.'),
            'detailPengguna'=>isset($email) ? $this->user->where(['md5(email)'=>$email])->find() : null,
            'aksiForm' =>isset($email) ? site_url('/update-pengguna') : site_url('/simpan-pengguna')
        ];

        $valdasiForm=[
            'txtEmail'=>'required',
            'txtNama'=>'required',
            'opsiLevelPengguna'=>'required'
        ];

        if($this->validate($valdasiForm)){
            $cek=$this->user->where(['email'=>$this->request->getPost('txtEmail')])->find();

            if($this->request->getPost('txtPassword')!=null) {
                // jika passsword belum ada
                $password=md5($this->request->getPost('txtPassword'));
            } else if ($cek[0]['password']!=null && $this->request->getPost('txtPassword')!=null) {
                // jika password ada di db dan pengguna merubah password
                $password=md5($this->request->getPost('txtPassword'));
            } else {
                // jika pengguna tidak merubah password
                $password=$cek[0]['password'];
            }

            $dataPengguna=[
                'email'=>$this->request->getPost('txtEmail'),
                'nama'=>$this->request->getPost('txtNama'),
                'password'=>$password, 
                'level'=>$this->request->getPost('opsiLevelPengguna'),
            ];


            if(count($cek)==0){
                $this->user->insert($dataPengguna);
            } else {
                $this->user->update($this->request->getPost('txtEmail'),$dataPengguna);
            }
             return redirect()->to(site_url('/pengguna'))->with('pesan','<div class="alert alert-success">New user saved successfully</div>');
            
        }

        return view('Pengguna/form-pengguna',$data);
    }


    public function hapusPengguna($email){
        $this->user->where(['md5(email)'=>$email])->delete();
        return redirect()->to(site_url('/pengguna'))->with('pesan','<div class="alert alert-danger">User successfully deleted</div>');


    }

    public function logout(){
        session()->destroy();
        return redirect()->to('/');
    }

    public function search()
{
    $keyword = $this->request->getGet('keyword');
    $model = new Muser();
    
    $data['listPengguna'] = $model
        ->like('email', $keyword)
        ->orLike('nama', $keyword)
        ->orLike('level', $keyword)
        ->findAll();

     return $this->response->setJSON($data);
}


    public function welcome($email){
        $model = new Muser();
        $user = $model->getUserById($email);

        var_dump($user); // Tambahkan ini untuk debugging

        if ($user) {
            return view('dashboard', ['nama' => $user['nama']]);
        } else {
            echo 'User not found';
        }
    }
    
}


