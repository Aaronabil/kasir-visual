<?=$this->extend('dashboard');?>
<?=$this->section('konten');?>
<h4 class="card-title"><?=$judulHalaman;?></h4>
<p class="card-description">
<?=$bio;?>
</p>
<form class="mt-3" method="POST">
<?=csrf_field();?>
<div class="form-group row">
    <label for="txtNamaProduk" class="col-md-3">Product Name</label>
    <div class="col-md-9">
        <!--<input type="hidden" name="txtProdukId" value="<?=isset($detailProduk[0]['ProdukID']) ? $detailProduk[0]['ProdukID'] : null;?>" />-->
        <input type="text" id="txtNamaProduk" name="txtNamaProduk" class="form-control" placeholder="Enter product name" autofocus autocomplete="off" value="<?=isset($detailProduk[0]['NamaProduk']) ? ucwords($detailProduk[0]['NamaProduk']) : null;?>" required onfocus="moveCursorToEnd(this)"/>
    </div>
</div>

<div class="form-group row">
    <label for="txtHargaBeliProduk" class="col-md-3">Product Purchase Price</label>
    <div class="col-md-9">
        <input type="text" id="txtHargaBeliProduk" name="txtHargaBeliProduk" class="form-control uang" placeholder="Enter the purchase price of the product"  autocomplete="off" value="<?=isset($detailProduk[0]['HargaBeli']) ? $detailProduk[0]['HargaBeli'] : null;?>" required/>
    </div>
</div>

<div class="form-group row">
    <label for="txtHargaJualProduk" class="col-md-3">Product Selling Price</label>
    <div class="col-md-9">
        <input type="text" id="txtHargaJualProduk" name="txtHargaJualProduk" class="form-control uang" placeholder="Enter the selling price of the product"   autocomplete="off" value="<?=isset($detailProduk[0]['Harga']) ? $detailProduk[0]['Harga'] : null;?>" required/>
    </div>
</div>

<div class="form-group row">
    <label for="txtStokProduk" class="col-md-3">Product Inventory (Stock) </label>
    <div class="col-md-9">
        <input type="text" id="txtStokProduk" name="txtStokProduk" class="form-control uang" value="<?=isset($detailProduk[0]['Stok']) ? $detailProduk[0]['Stok'] : null;?>" placeholder="Enter stock items" autocomplete="off"/>
    </div>
</div>


<div class="form-group row">
    <div class="col-md-3">
     <button class="btn btn-primary btn-sm">Save</button>   
     <a href="/produk" class="btn btn-danger btn-sm">Cancel</a>
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

<?=$this->endSection();?>