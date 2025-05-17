<?=$this->extend('dashboard');?>
<?=$this->section('konten');?>
<h4 class="card-title"><?=$judulHalaman;?></h4>
<?php
$session = session();
$username = ucwords($session->get('username'));
?>
<p class="card-description">
                    Date : <?=date('d-M-Y');?>  .::. Cashier :  <?=esc($username)?>::. No. Faktur : 000001
                  </p>
<hr/>
<div class="row">
    <div class=" col-sm-12">
        <?=session()->getFlashdata('pesan');?>
    </div>
</div>


<div class="row">


    <div class="col-sm-5">
    <!-- kolom 1 -->
    <form method="POST">
    <div class="form-group">
        <label for="exampleInputUsername2"><strong>Customer</strong></label>
            <select class="form-control" name="opsiPelanggan" readonly>
                <option>-- Select Customer --</option>
                <?php
                if(isset($listPelanggan)){
                    foreach($listPelanggan as $row){
                        session()->get('IdPelanggan')==$row['PelangganID'] ? $pilihPelanggan='selected' : $pilihPelanggan=null;  
                        echo '<option '.$pilihPelanggan.' value="'.$row['PelangganID'].'">'.ucwords($row['NamaPelanggan']).'</option>';
                    }
                }

                ?>
            </select>
    </div>

    <div class="form-group">
        <label for="exampleInputUsername2"><strong>Product</strong></label>
            <select class="form-control" name="opsiProduk">
                <option>-- Select Product --</option>`
                <?php
                if(isset($listProduk)){
                    foreach($listProduk as $row){
                        if($row['Stok']>0){
                            echo '<option value="'.$row['ProdukID'].'">'.ucwords($row['NamaProduk']).' ('.$row['Stok'].') - Rp'.number_format($row['Harga'],2,',','.').'</option>';
                        }
                    }
                }

                ?>
            </select>
    </div>

    <div class="form-group">
        <label for="txtJumlahJual"><strong>Total Items</strong></label>
            <input type="text" class="form-control uang" name="txtJumlahJual" id="txtJumlahJual" placeholder="Enter the number of items" autocomplete="off">
    </div>

        <button type="submit" class="btn btn-primary btn-sm me-2">Save</button>
        <?php
        session()->get('IdPelanggan')==null ? $tombolBayarNonAktif='style="pointer-events: none"' : $tombolBayarNonAktif=null;
        ?>
        <a href="<?=site_url('/bayar');?>" <?=$tombolBayarNonAktif;?> class="btn btn-success btn-sm me-2">Payment</a>
    </form>

    <!-- end kolom 1 -->
    </div>

    <div class="col-sm-7">
    <!-- kolom 2 -->

    <table class="table">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Amount</th>
                <th>Sub Total</th>
            </tr>
        </thead>
        <tbody>
          <?php
          if(isset($listProdukTerjual)) {
            $no=null;
            $total=null;
            foreach($listProdukTerjual as $row){
                $no++;
                echo '<tr>
                <td>'.ucwords($row['NamaProduk']).'</td>
                <td align="right">'.$row['JumlahProduk'].'</td>
                <td align="right">Rp'.number_format($row['Subtotal'],2,',','.').'</td>
                </tr>';
                $total = $total+$row['Subtotal'];

            }
          }
          ?>
        </tbody>
    </table>
    <h4 align="right" class="mt-4"><strong>Total Price : Rp<?=number_format($total,2,',','.');?></strong></h4>
        
    <!-- end kolom 2 -->
    </div>
</div>









<?=$this->endSection();?>