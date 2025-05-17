<?=$this->extend('dashboard');?>
<?=$this->section('konten');?>
<h4 class="card-title"><?=$judulHalaman;?></h4>
<?=session()->getFlashdata('pesan');?>

<p><a href="<?=site_url('/tambah-produk');?>" class="btn btn-sm btn-primary"><i class="mdi mdi-apps m-1"></i>Add product</a></p>
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
        <tbody>
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
<?=$this->endSection();?>