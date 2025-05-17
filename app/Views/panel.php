                    <div class="row">
                      <div class="col-sm-12">
                        <div class="statistics-details d-flex align-items-center justify-content-between">
                          <div class="counter">
                            <p class="statistics-title">Sales today</p>
                            <h3 class="rate-percentage count" data-target="<?=isset($pendapatanHariIni[0]['TotalPendapatan']) ? number_format($pendapatanHariIni[0]['TotalPendapatan'],0,',','.') : 0;?>">Rp.</h3>
                            <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>-0.5%</span></p>
                          </div>
                          <div class="counter">
                            <p class="statistics-title">Sales this month</p>
                            <h3 class="rate-percentage count" data-target="<?=isset($pendapatanBulanIni[0]['TotalPendapatan']) ? number_format($pendapatanBulanIni[0]['TotalPendapatan'],0,',','.'):0;?>">Rp.0</h3>
                            <p class="text-success d-flex"><i class="mdi mdi-menu-up"></i><span>+0.1%</span></p>
                          </div>
                          <div>
                            <p class="statistics-title">Stock is empty</p>
                            <h3 class="rate-percentage"><?=number_format($produkStokKosong[0]['JmlProduk'],0,',','.');?> Product</h3>
                            <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>68.8</span></p>
                          </div>
                          <div class="d-none d-md-block counter">
                            <p class="statistics-title" data-target="">Performance this month</p>
                            <?php if (count($pendapatanDuaBlnTerakhir) >= 2): ?>
                            <?php
                            $selisih = $pendapatanDuaBlnTerakhir[0]['TotalPendapatan'] - $pendapatanDuaBlnTerakhir[1]['TotalPendapatan'];
                            $persentaseSelisih = number_format(($selisih / $pendapatanDuaBlnTerakhir[1]['TotalPendapatan']) * 100, 2, ',', '.');
                            ?>
                            <h3 class="rate-percentage count" data-target="<?= number_format(abs($selisih), 0, ',', '.'); ?>">Rp.0</h3>
                            <p class="<?= $selisih < 0 ? 'text-danger' : 'text-success'; ?> d-flex">
                            <i class="mdi <?= $selisih < 0 ? 'mdi-menu-down' : 'mdi-menu-up'; ?>"></i>
                            <span><?= $persentaseSelisih; ?> %</span>
                            </p>
                            <?php else: ?>
      <h3 class="rate-percentage">Data not available</h3>
      <p class="text-muted d-flex">
        <i class="mdi mdi-information-outline"></i>
        <span>-</span>
      </p>
  <?php endif; ?>
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

    <script>
      document.addEventListener("DOMContentLoaded", function() {
        const counters = document.querySelectorAll('.count');
        const speed = 80;
        counters.forEach((counter) => {
          const updateCount = () => {
            const target = +counter.getAttribute('data-target').replace(/[^0-9]/g, '');
            const count = +counter.textContent.replace(/[^0-9]/g, '');
            const increment = Math.floor(target / speed);

            if (count < target) {
              counter.textContent = 'Rp.' + (count + increment).toLocaleString('id-ID');
              setTimeout(updateCount, 30);
            } else {
              counter.textContent = 'Rp.' + target.toLocaleString('id-ID');
            }
          };
          updateCount();
        });
      });
    </script>
