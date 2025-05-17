<?=$this->extend('dashboard');?>
<?=$this->section('konten');?>
<h4 class="card-title"><?=$judulHalaman;?></h4>
<p>The following is the stock report up to date <?=date('d M Y');?>.</p>
<p><a href="<?=site_url('/download-pdf');?>" class="btn btn-sm btn-danger"><i class="mdi mdi-file-pdf-box m-1"></i>Download PDF</a></p>
<div class="table-responsive">
    <table class="table table-stripped">
        <thead>
            <tr>
                <th>No</th>
                <th>Product Name</th>
                <th>Purchase Price</th>
                <th>Selling Price</th>
                <th>Stock</th>
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
                $html .='<td class="text-left">'.$no.'.</td>';
                $html .='<td>'.ucwords($row['NamaProduk']).'</td>';
                $html .='<td align="right">'.number_format($row['HargaBeli'],2,',','.').'</td>';
                $html .='<td align="right">'.number_format($row['Harga'],2,',','.').'</td>';
                $html .='<td class="text-center">'.$row['Stok'].'</td>';
                $html .='</tr>';
            endforeach;
            echo $html;        
        endif;    
        ?>

        </tbody>
    </table>
</div>


<?=$this->endSection();?>