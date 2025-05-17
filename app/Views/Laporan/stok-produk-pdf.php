<!DOCTYPE html>  
<html lang="en">  

<head>  
    <meta charset="UTF-8">  
    <meta http-equiv="X-UA-Compatible" content="IE=edge">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Product Stock Report - Warung Madura</title>  

</head>  

<body>  
<h2 align="center">Warung Madura<br/>Product Stock Report</h2>  
<p  align="center">As of date <?=date('d M Y');?>
<table border="1" width="100%" cellpadding="2" cellspacing="0" style="margin-top: 5px;">  
    <thead>    
        <tr bgcolor="silver" align="center">  
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
                foreach($listProduk as $row) :
                $no++;    
            ?>        
            <tr>
                <td align="center"><?=$no;?>.</td>  
                <td><?=$row['NamaProduk'];?></td>  
                <td align="right">Rp<?=number_format($row['HargaBeli'],2,',','.');?></td>  
                <td align="right">Rp<?=number_format($row['Harga'],2,',','.');?></td>  
                <td align="right"><?=number_format($row['Stok'],0,',','.');?></td>  
            </tr>
            <?php
                endforeach;
            endif;
            ?>
        </tbody>
    </table>  
</body>  

</html>