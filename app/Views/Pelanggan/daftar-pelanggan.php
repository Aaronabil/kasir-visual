<?=$this->extend('dashboard');?>
<?=$this->section('konten');?>
<h4 class="card-title"><?=$judulHalaman;?></h4>
<?=session()->getFlashdata('pesan');?>

<p><a href="<?=site_url('/tambah-pelanggan');?>" class="btn btn-sm btn-primary"><i class="mdi mdi-account-plus m-1"></i>Add Customer</a></p>
<div class="row mb-3">
    <div class="col-md-6">
        <input type="text" id="searchInput" class="form-control" placeholder="Search User..." autocomplete="off">
    </div>
</div>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Contact Number</th>
                <th>Name</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="dataPelanggan">
        <?php
        if(isset($listPelanggan)) :
            $no=null;
            $html=null;
            foreach($listPelanggan as $row):
                $no++;
                $html .='<tr>';
                $html .='<td class="text-left">'.$no.'</td>';
                $html .='<td>'.$row['NomorTelepon'].'</td>';
                $html .='<td>'.ucwords($row['NamaPelanggan']).'</td>';
                $html .='<td>'.ucwords($row['Alamat']).'</td>';
                $html .='<td class="center">
                        <a href="'.site_url('/edit-pelanggan/'.md5($row['PelangganID'])).'" class="m-1"><i span class="mdi mdi-account-edit-outline"></i></a>

                        <a href="'.site_url('/hapus-pelanggan/'.md5($row['PelangganID'])).'" class="deleteLink m-1" data-confirm="Anda yakin ?"><i span class="mdi mdi-alert-outline text-danger"></i></a>
                        
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

// Panggil saat halaman sudah siap
document.addEventListener('DOMContentLoaded', function () {
     setupDeleteLinks();
    // Tambahkan event untuk search
    document.getElementById('searchInput').addEventListener('input', function () {
        const keyword = this.value;

        fetch("<?= site_url('/pelanggan/search') ?>?keyword=" + encodeURIComponent(keyword))
            .then(res => res.json())
            .then(data => {
                const tbody = document.getElementById('dataPelanggan');
                tbody.innerHTML = '';

                const list = data.listPelanggan;

                if (!list || list.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="5" class="text-center">Customer not found.</td></tr>';
                    return;
                }

                list.forEach((user, index) => {
                    const idHash = CryptoJS.MD5(user.PelangganID).toString();

                    tbody.innerHTML += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${user.NomorTelepon}</td>
                            <td>${ucwords(user.NamaPelanggan)}</td>
                            <td>${ucwords(user.Alamat)}</td>
                            <td>
                                <a href="/edit-pelanggan/${idHash}" class="m-1"><i class="mdi mdi-account-edit-outline"></i></a>
                                <a href="/hapus-pelanggan/${idHash}" class="deleteLink m-1">
                                    <i class="mdi mdi-alert-outline text-danger"></i>
                                </a>
                            </td>
                        </tr>
                    `;
                });

                // Penting: Bind ulang event delete setelah search
                setupDeleteLinks();
            })
            .catch(err => {
                console.error("Fetch error:", err);
            });
    });
});
</script>
<?=$this->endSection();?>