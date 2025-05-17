<?=$this->extend('dashboard');?>
<?=$this->section('konten');?>
<h4 class="card-title"><?=$judulHalaman;?></h4>
<?=session()->getFlashdata('pesan');?>

<p><a href="<?=site_url('/tambah-pengguna');?>" class="btn btn-sm btn-primary"><i class="mdi mdi-account-multiple-plus m-1"></i>Add User</a></p>
<div class="row mb-3">
    <div class="col-md-6">
        <input type="text" id="searchInput" class="form-control" placeholder="Search User...">
    </div>
</div>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email (Username)</th>
                <th>Level</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="dataPengguna">
        <?php
        if(isset($listPengguna)) :
            $no=null;
            $html=null;
            foreach($listPengguna as $row):
                $no++;
                $html .='<tr>';
                $html .='<td class="text-left">'.$no.'</td>';
                $html .='<td>'.ucwords($row['nama']).'</td>';
                $html .='<td>'.$row['email'].'</td>';
                $html .='<td>'.ucwords($row['level']).'</td>';
                $html .='<td class="center">
                        <a href="'.site_url('/edit-pengguna/'.md5($row['email'])).'" class="m-1" style="text-decoration: none;"><i span class="mdi mdi-account-edit-outline"></i></a>

                        <a href="'.site_url('/hapus-pengguna/'.md5($row['email'])).'" class="deleteLink text-danger"><i span class="mdi mdi-alert-outline text-danger"></i></a>
                        
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
<script>
  document.addEventListener('DOMContentLoaded', function() {
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
  });
</script>   
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
<script>
document.getElementById('searchInput').addEventListener('input', function () {
    const keyword = this.value;

    fetch("<?= site_url('/pengguna/search') ?>?keyword=" + encodeURIComponent(keyword))
        .then(res => res.json())
        .then(data => {
            const tbody = document.getElementById('dataPengguna');
            tbody.innerHTML = '';

            const list = data.listPengguna;

            if (!list || list.length === 0) {
                tbody.innerHTML = '<tr><td colspan="5" class="text-center">User not found.</td></tr>';
                return;
            }

            list.forEach((user, index) => {
                tbody.innerHTML += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${user.nama}</td>
                        <td>${user.email}</td>
                        <td>${user.level}</td>
                        <td>
                            <a href="/edit-pengguna/${CryptoJS.MD5(user.email)}" class="m-1" style="text-decoration: none;">
                                <i class="mdi mdi-account-edit-outline"></i>
                            </a>
                            <a href="/hapus-pengguna/${CryptoJS.MD5(user.email)}" class="deleteLink text-danger">
                                <i class="mdi mdi-alert-outline text-danger"></i>
                            </a>
                        </td>
                    </tr>
                `;
            });
        })
        .catch(err => {
            console.error("Fetch error:", err);
        });
});
</script>




<?=$this->endSection();?>