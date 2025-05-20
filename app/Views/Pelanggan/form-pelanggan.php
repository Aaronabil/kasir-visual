<?=$this->extend('dashboard');?>
<?=$this->section('konten');?>
<h4 class="card-title"><?=$judulHalaman;?></h4>
<p class="card-description">
<?=$bio;?>
</p>
<form class="mt-3" method="POST">
<?=csrf_field();?>
<div class="form-group row">
    <label for="txtNamaPelanggan" class="col-md-3">Name</label>
    <div class="col-md-9">
        <input type="text" id="txtNamaPelanggan" name="txtNamaPelanggan" class="form-control" placeholder="Enter customer" <?=isset($detailPelanggan[0]['NamaPelanggan']) ? 'autofocus' :null;?> autocomplete="off" value="<?=isset($detailPelanggan[0]['NamaPelanggan']) ? ucwords($detailPelanggan[0]['NamaPelanggan']) : null;?>" required onfocus="moveCursorToEnd(this)"/>
    </div>
</div>

<div class="form-group row">
    <label for="txtNoTelpPelanggan" class="col-md-3"> Customer Telephone Number</label>
    <div class="col-md-9">
        <input type="number" id="txtNoTelpPelanggan" name="txtNoTelpPelanggan" class="form-control" placeholder="Enter telephone number"  <?=isset($detailPelanggan[0]['NomorTelepon']) ? 'autofocus' :null;?>  autocomplete="off" value="<?=isset($detailPelanggan[0]['NomorTelepon']) ? $detailPelanggan[0]['NomorTelepon'] : null;?>" required/>
    </div>
</div>

<div class="form-group row">
    <label for="txtPassword" class="col-md-3">Address</label>
    <div class="col-md-9">
        <input type="text" id="txtAlamatPelanggan" name="txtAlamatPelanggan" class="form-control" placeholder="Enter address" value="<?=isset($detailPelanggan[0]['Alamat']) ? ucwords($detailPelanggan[0]['Alamat']) : null;?>" autocomplete="off" required/>
    </div>
</div>


<div class="form-group row">
    <div class="col-md-3">
     <button class="btn btn-primary btn-sm">Save</button>
     <a href="/pelanggan" class="btn btn-danger btn-sm">Cancel</a>
    </div>
</div>
</form>

<script>
function moveCursorToEnd(el) {
    setTimeout(function() {
        el.selectionStart = el.selectionEnd = el.value.length;
    }, 0);
}
</script>

<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
    var input = document.getElementById('txtNamaPelanggan');
    input.addEventListener('focus', function() {
        setTimeout(function() {
            input.selectionStart = input.selectionEnd = input.value.length;
        }, 0);
    });
});
</script> -->

<?=$this->endSection();?>