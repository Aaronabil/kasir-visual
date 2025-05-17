<?=$this->extend('dashboard');?>
<?=$this->section('konten');?>
<h4 class="card-title"><?=$judulHalaman;?></h4>
<?=session()->getFlashdata('pesan');?>

<p><a href="<?=site_url('/tambah-produk');?>" class="btn btn-sm btn-primary"><i class="mdi mdi-apps m-1"></i>Add product</a></p>
<div class="row mb-3">
    <div class="col-md-6">
        <input type="text" id="searchInput" class="form-control" placeholder="Search Product..." autocomplete="off">
    </div>
</div>
<div class="table-responsive">
    <table class="table table-stripped">
        <thead>
            <tr>
                <th>No</th>
                <th>Product Name</th>
                <th>Purchase Price</th>
                <th>Selling Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="dataProduk">
        <?php
        if(isset($listProduk)) :
            $no=null;
            $html=null;
            foreach($listProduk as $row):
                $no++;
                $html .='<tr>';
                $html .='<td class="center">'.$no.'.</td>';
                $html .='<td>'.ucwords($row['NamaProduk']).'</td>';
                $html .='<td align="left">'.number_format($row['HargaBeli'],2,',','.').'</td>';
                $html .='<td align="left">'.number_format($row['Harga'],2,',','.').'</td>';
                $html .='<td class="center">
                        <a href="'.site_url('/edit-produk/'.md5($row['ProdukID'])).'" class="m-1"><i span class="mdi mdi-book-edit-outline"></i></a>

                        <a href="'.site_url('/hapus-produk/'.md5($row['ProdukID'])).'"class="deleteLink m-1" data-confirm="Anda yakin ?"><i span class="mdi mdi-alert-outline text-danger"></i></a>
                        
                        </td>';
                $html .='</tr>';
            endforeach;
            echo $html;        
        endif;    
        ?>
        </tbody>   
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
<script>
function ucwords(str) {
    return str.replace(/\b\w/g, c => c.toUpperCase());
}

function setupDeleteLinks() {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-lg btn-primary m-1",
            cancelButton: "btn btn-lg btn-danger"
        },
        buttonsStyling: false
    });

    document.querySelectorAll('.deleteLink').forEach(function(element) {
        element.addEventListener('click', function(event) {
            event.preventDefault();
            const href = this.getAttribute('href');
            
            swalWithBootstrapButtons.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    swalWithBootstrapButtons.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success",
                        padding: '2em',
                    }).then(() => {
                        window.location.href = href;
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire({
                        title: "Cancelled",
                        text: "Your data is safe :)",
                        icon: "error",
                        padding: '2em',
                    });
                }
            });
            document.querySelector('.swal2-icon').style.marginTop = '20px'; // Atur margin atas sesuai kebutuhan
        });
    });
}

document.addEventListener('DOMContentLoaded', function () {
    setupDeleteLinks(); // Pasang saat awal

    document.getElementById('searchInput').addEventListener('input', function () {
        const keyword = this.value;

        fetch("<?= site_url('/produk/search') ?>?keyword=" + encodeURIComponent(keyword))
            .then(res => res.json())
            .then(data => {
                const tbody = document.getElementById('dataProduk');
                tbody.innerHTML = '';

                const list = data.listProduk;

                if (!list || list.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="5" class="text-center">Product not found.</td></tr>';
                    return;
                }

                list.forEach((item, index) => {
                    const idHash = CryptoJS.MD5(item.ProdukID).toString();
                    tbody.innerHTML += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${ucwords(item.NamaProduk)}</td>
                            <td align="left">${parseFloat(item.HargaBeli).toLocaleString('id-ID', {minimumFractionDigits: 2})}</td>
                            <td align="left">${parseFloat(item.Harga).toLocaleString('id-ID', {minimumFractionDigits: 2})}</td>
                            <td class="center">
                                <a href="/edit-produk/${idHash}" class="m-1"><i class="mdi mdi-book-edit-outline"></i></a>
                                <a href="/hapus-produk/${idHash}" class="deleteLink m-1">
                                    <i class="mdi mdi-alert-outline text-danger"></i>
                                </a>
                            </td>
                        </tr>
                    `;
                });

                setupDeleteLinks(); // Pasang lagi setelah update
            })
            .catch(err => console.error("Fetch error:", err));
    });
});
</script>
<?=$this->endSection();?>