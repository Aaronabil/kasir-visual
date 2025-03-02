                    <div class="row">
                      <div class="col-sm-12">
                        <div class="statistics-details d-flex align-items-center justify-content-between">
                          <div>
                            <p class="statistics-title">Sales today</p>
                            <h3 class="rate-percentage">Rp<?=isset($pendapatanHariIni[0]['TotalPendapatan']) ? number_format($pendapatanHariIni[0]['TotalPendapatan'],0,',','.') : 0;?></h3>
                            <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>-0.5%</span></p>
                          </div>
                          <div>
                            <p class="statistics-title">Sales this month</p>
                            <h3 class="rate-percentage">Rp<?=isset($pendapatanBulanIni[0]['TotalPendapatan']) ? number_format($pendapatanBulanIni[0]['TotalPendapatan'],0,',','.'):0;?></h3>
                            <p class="text-success d-flex"><i class="mdi mdi-menu-up"></i><span>+0.1%</span></p>
                          </div>
                          <div>
                            <p class="statistics-title">Stock is empty</p>
                            <h3 class="rate-percentage"><?=number_format($produkStokKosong[0]['JmlProduk'],0,',','.');?> Product</h3>
                            <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>68.8</span></p>
                          </div>
                          <div class="d-none d-md-block">
                            <p class="statistics-title">Performance this month</p>
                            <h3 class="rate-percentage"><?php
                            $selisih=$pendapatanDuaBlnTerakhir[0]['TotalPendapatan']-$pendapatanDuaBlnTerakhir[0]['TotalPendapatan'];
                            echo number_format(abs($selisih),0,',','.');
                            
                            $persentaseSelsisih=number_format(($selisih/$pendapatanDuaBlnTerakhir[0]['TotalPendapatan'])*100,2,',','.');
                            ;?></h3>
                            <p class="<?=$selisih<0 ? 'text-danger' : 'text-success';?> d-flex"><i class="mdi <?=$selisih<0 ? 'mdi-menu-down' : 'mdi-menu-up';?>"></i><span><?=$persentaseSelsisih;?> %</span></p>
                          </div>
                        </div>
  <div class="row">
      <div class="col-lg-12">
          <h4 class="card-title text-center">Income trend graph<br/>in <?=date('Y');?></h4>             
        <div class="mt-3">
          <canvas id="leaveReport" style="min-height:250px"></canvas>
        </div>
      </div>
    </div>
