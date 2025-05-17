<?=$this->extend('dashboard');?>
<?=$this->section('konten');?>
<h4 class="card-title"><?=$judulHalaman;?></h4>
<p class="card-description">
Please enter your payment details in the form below.
</p>

<?php if(session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<form action="<?= site_url('pembayaran/prosesBayar'); ?>" method="post">

    <input type="hidden" name="totalHarga" value="<?= $detailPenjualan[0]['TotalHarga']; ?>">

    <div class="form-group row">
        <label for="txtHargaBeli" class="col-md-3">Total Price</label>
        <div class="col-md-9">
            <input type="text" id="txtHargaBeli" name="txtHargaBeli" class="form-control" placeholder="Masukkan harga beli produk" value ="<?=number_format($detailPenjualan[0]['TotalHarga'],0,'.',',');?>" readonly/>
        </div>
    </div>

    <div class="form-group text-right">
        <button type="button" class="btn btn-warning btn-sm" onclick="insertAmount(50000)">50.000</button>
        <button type="button" class="btn btn-warning btn-sm" onclick="insertAmount(100000)">100.000</button>
    </div>

    <div class="form-group row">
        <label for="txtUangBayar" class="col-md-3">Payment</label>
        <div class="col-md-9">
            <input type="text" id="txtUangBayar" name="uangBayar" class="form-control uang" placeholder="Enter the payment amount" oninput="calculateChange()" autofocus autocomplete="off" required/>
        </div>
    </div>

    <div class="form-group row">
        <label for="txtUangKembali" class="col-md-3">Change</label>
        <div class="col-md-9">
            <input type="text" id="txtUangKembali" name="txtUangKembali" class="form-control uang" readonly required/>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-3">
        <button type="submit" class="btn btn-primary btn-sm">Pay</button>
        <a href="<?=site_url('/penjualan');?>" class="btn btn-danger btn-sm">Back</a>   
        </div>
    </div>
</form>

<script>
function insertAmount(amount) {
    document.getElementById('txtUangBayar').value = amount.toLocaleString('id-ID');
    calculateChange();
}

function calculateChange() {
    var totalHarga = <?= $detailPenjualan[0]['TotalHarga']; ?>;
    var uangBayar = parseInt(document.getElementById('txtUangBayar').value.replace(/\./g, '')) || 0;
    var uangKembali = uangBayar - totalHarga;
    if (uangBayar > 0) {
        document.getElementById('txtUangKembali').value = uangKembali.toLocaleString('id-ID');
    } else {
        document.getElementById('txtUangKembali').value = '';
    }
}
</script>
</script>

<?=$this->endSection();?>
