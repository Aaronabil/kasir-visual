<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Mpelanggan;

class Pelanggan extends BaseController
{
    public function index()
    {
        $data=[
            'judulHalaman'=>'<i class="mdi mdi-account-box-outline"></i> Customer List',
            'listPelanggan'=>$this->pelanggan->findAll()
        ];
        return view('Pelanggan/daftar-pelanggan',$data);
    }

    public function tambahPelanggan($idPelanggan=null){
        $data=[
            'judulHalaman'=>'<i class="mdi mdi-account-box-outline"></i>'.(isset($idPelanggan) ? 'Edit Customer' : 'Form Customer'),
            'bio'=>(isset($idPelanggan) ? 'Please edit customer data in the form below.' : 'Please enter customer data in the form below.'),
            'detailPelanggan'=>isset($idPelanggan) ? $this->pelanggan->where(['md5(PelangganID)'=>$idPelanggan])->find() : null
        ];

        $valdasiForm=[
            'txtNamaPelanggan'=>'required',
            'txtAlamatPelanggan'=>'required',
            'txtNoTelpPelanggan'=>'required'
        ];

        if($this->validate($valdasiForm)){
            $cekPelanggan=$this->pelanggan->where(['md5(PelangganID)'=>$idPelanggan])->findAll();
            
            $dataPelanggan=[
                'NamaPelanggan'=>$this->request->getPost('txtNamaPelanggan'),
                'Alamat'=>$this->request->getPost('txtAlamatPelanggan'),
                'NomorTelepon'=>$this->request->getPost('txtNoTelpPelanggan')
            ];

            if(count($cekPelanggan)==0){
                $this->pelanggan->insert($dataPelanggan);
            } else {
                $this->pelanggan->update($cekPelanggan[0]['PelangganID'],$dataPelanggan);
            }

            return redirect()->to(site_url('/pelanggan'))->with('pesan','<div class="alert alert-success">Customer data has been successfully saved</div>');
        }

        return view('Pelanggan/form-pelanggan',$data);
    }


    public function hapusPelanggan($idPelanggan){
        $this->pelanggan->where(['md5(PelangganID)'=>$idPelanggan])->delete();
        return redirect()->to(site_url('/pelanggan'))->with('pesan','<div class="alert alert-danger">Customer data has been successfully deleted</div>');
    }

    public function search(){
    $keyword = $this->request->getGet('keyword');
    $model = new Mpelanggan();
    
    $data['listPelanggan'] = $model
        ->like('NamaPelanggan', $keyword)
        ->orLike('Alamat', $keyword)
        ->orLike('NomorTelepon', $keyword)
        ->findAll();

     return $this->response->setJSON($data);
    }

}
