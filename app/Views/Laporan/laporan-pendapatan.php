<?=$this->extend('dashboard');?>
<?=$this->section('konten');?>
<h4 class="card-title"><?=$judulHalaman.' '.(isset($jenisLaporan) ? $jenisLaporan:null);?></h4>

<?php
if(!isset($jenisLaporan)) : ?>
<p class="card-description">
Please select the type and income reporting period in the form below.
</p>
<form class="mt-3" method="POST">
<?=csrf_field();?>

<div class="form-group row">
    <label for="opsiJenisLaporan" class="col-md-3">Type of Income Report</label>
    <div class="col-md-9">
            <select class="form-control" name="opsiJenisLaporan" required>
                <option  value="harian">Daily Report</option>
                <option  value="bulanan">Monthly Report</option>
                <!-- <option  value="tahunan">Annual Report</option> -->
            </select>
    </div>
</div>

<div class="form-group row">
    <label for="txtTanggalLaporan" class="col-md-3">Reporting Period</label>
    <div class="col-md-9">
        <input type="date" id="txtTanggalLaporan" name="txtTanggalLaporan" class="form-control" placeholder="Masukan nama pengguna"  autocomplete="off" value="<?=date('Y-m-d');?>" required/>
    </div>
</div>


<div class="form-group row">
    <div class="col-md-3">
     <button class="btn btn-primary btn-sm">Show</button>   
    </div>
</div>
</form>

<?php else  :  ?>
<p class="card-description">
The following is the <?=$jenisLaporan;?> report for the period <?=$periodeLaporan;?>
</p>    
<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Sale Date</th>
            <th>Purchase Price</th>
            <th>Sale</th>
            <th>Margin</th>
            <th>(%) Margin</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if(isset($listLaporan)) : 
            $no=null;
            $totalPenjualan=null;
            $totalMargin=null;
            $totalHPP=null;
            foreach($listLaporan as $row) :
                $no++;
                $totalHPP=$totalHPP+$row['HargaBeli'];
                $totalPenjualan=$totalPenjualan+$row['HargaJual'];
                $totalMargin=$totalMargin+$row['Margin'];
        ?>           
            <tr>    
                <td><?=$no;?></td>
                <td><?=$row['TanggalPenjualan'];?></td>
                <td align="right"><?=number_format($row['HargaBeli'],0,',','.');?></td>
                <td align="right"><?=number_format($row['HargaJual'],0,',','.');?></td>
                <td align="right"><?=number_format($row['Margin'],0,',','.');?></td>
                <td align="right"><?=number_format(($row['Margin']/$row['HargaBeli'])*100,2,',','.');?>%</td>

            </tr>
        <?php        
            endforeach;    
        endif;  
        ?>

    </tbody>
    <tfoot>
        <tr>
            <td colspan="2"><strong>Total</strong></td>
            <td align="right"><strong><?=number_format($totalHPP,0,',','.');?></strong></td>
            <td align="right"><strong><?=number_format($totalPenjualan,0,',','.');?></strong></td>
            <td align="right"><strong><?=number_format($totalMargin,0,',','.');?></strong></td>
            <td align="right"><strong><?=($totalHPP==0 ? 0 : number_format(($totalMargin/$totalHPP)*100,2,',','.'));?>%</strong></td>
        </tr>        
    </tfoot>
</table>

<?php if($totalHPP != 0)  :  ?>
<p class="card-description">
<b>Description:</b> 
    <br/>Sales on <?=$periodeLaporan;?> generated revenue of <strong>Rp<?=number_format($totalPenjualan,0,',','.');?></strong>, he gross profit obtained was <strong>Rp<?=number_format($totalMargin,0,',','.');?></strong>, the profit percentage from the cost of goods sold is  <strong><?=number_format(($totalMargin/$totalHPP)*100,2,',','.');?>%</strong>.
</p>

<div class="form-group row">
    <div class="col-md-3">
     <a href="/laporan-pendapatan" class="btn btn-danger btn-sm">Back</a>
    </div>
</div>
<?php endif; ?>

<?php endif;?>

<?=$this->endSection();?>
