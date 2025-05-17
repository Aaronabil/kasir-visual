<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Mproduk;

class Produk extends BaseController
{
    public function index()
    {
        // $model = new Mproduk();

            $data=[
                'judulHalaman'=>'<i class="mdi mdi-apps menu-icon-outline"></i> Product List',
                'listProduk'=>$this->produk->findAll(),
                // 'produk' => $model->paginate(3), // 10 produk per halaman
                // 'pager' => $model->pager,
            ];
            return view('Produk/daftar-produk',$data);
    }

    public function hapusProduk($idProduk){
        $this->produk->where(['md5(ProdukID)'=>$idProduk])->delete();
        return redirect()->to(site_url('/produk'))->with('pesan','<div class="alert alert-danger">The product has been successfully deleted</div>');
    }

    public function tambahProduk($idProduk=null){
        $data=[
            'judulHalaman'=>'<i class="mdi mdi-apps menu-icon-outline"></i>'.(isset($idProduk) ? 'Edit Product' : 'Form Product'),
            'bio'=>(isset($idProduk) ? 'Please edit products in the form below.' : 'Please enter products in the form below.'),
            'detailProduk'=>isset($idProduk) ? $this->produk->where(['md5(ProdukID)'=>$idProduk])->find() : null
        ];

        $valdasiForm=[
            'txtNamaProduk'=>'required',
            'txtHargaBeliProduk'=>'required',
            'txtHargaJualProduk'=>'required',
            'txtStokProduk'=>'required'
        ];

        if($this->validate($valdasiForm)){
            $cekProduk=$this->produk->where(['md5(ProdukID)'=>$idProduk])->findAll();
            
            // str_replace membuang tanda titik
            $dataProduk=[
                'NamaProduk'=>$this->request->getPost('txtNamaProduk'),
                'Harga'=>str_replace('.','',$this->request->getPost('txtHargaJualProduk')), 
                'HargaBeli'=>str_replace('.','',$this->request->getPost('txtHargaBeliProduk')), 
                'Stok'=>str_replace('.','',$this->request->getPost('txtStokProduk')),
            ];

            if(count($cekProduk)==0){
                if(str_replace('.','',$this->request->getPost('txtHargaJualProduk')) <= str_replace('.','',$this->request->getPost('txtHargaBeliProduk') )) {
                    
                return redirect()->to(site_url('/produk'))->with('pesan','<div class="alert alert-warning"><b>The selling price cannot be less than the buying price</b></div>');
                    
                  }  else {
                    
                     $cekNamaProduk=$this->produk->where(['NamaProduk'=>$this->request->getPost('txtNamaProduk')])->findAll();
                    
                    if(count($cekNamaProduk)==0){
                        $this->produk->insert($dataProduk);
                    } else {
                       return redirect()->to(site_url('/produk'))->with('pesan','<div class="alert alert-warning">A product with the name <b>'.ucfirst($this->request->getPost('txtNamaProduk')).'</b> already exists</div>');   
                        
                    }
                     
                     return redirect()->to(site_url('/produk'))->with('pesan','<div class="alert alert-success">Product saved successfully</div>');
                  }
                
            
                
            } else {
                $this->produk->update($cekProduk[0]['ProdukID'],$dataProduk);
                
                return redirect()->to(site_url('/produk'))->with('pesan','<div class="alert alert-success">Product updated successfully</div>');
            }


        }    
        return view('Produk/form-produk',$data);

    }
}
