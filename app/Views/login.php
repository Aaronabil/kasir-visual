
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Cashier Application</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?=base_url('assets/vendors/feather/feather.css');?>">
  <link rel="stylesheet" href="<?=base_url('assets/vendors/mdi/css/materialdesignicons.min.css');?>">
  <link rel="stylesheet" href="<?=base_url('assets/vendors/ti-icons/css/themify-icons.css');?>">
  <link rel="stylesheet" href="<?=base_url('assets/vendors/typicons/typicons.css');?>">
  <link rel="stylesheet" href="<?=base_url('assets/vendors/simple-line-icons/css/simple-line-icons.css');?>">
  <link rel="stylesheet" href="<?=base_url('assets/vendors/css/vendor.bundle.base.css');?>">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?=base_url('assets/css/vertical-layout-light/style.css');?>">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?=base_url('assets/images/kasir.jpg');?>" /> 
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
<!--                <img src="<?=base_url('assets/images/logo.svg');?>" alt="logo">-->
                <h2 class="fw-bold">Cashier</h2>
              </div>
              <h6 class="fw-light">Please log in with your account</h6>
              <?php if (session()->getFlashdata('msg')): ?>
                  <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
              <?php endif; ?>
              <form class="pt-3" action="<?=site_url('/loginSubmit');?>" method="post">
                <div class="form-group">
                  <input type="email" name="email" class="form-control form-control-lg" id="email" placeholder="Email" autocomplete="off">
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Password">
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn w-100" >Login</button>
                </div>



                <div class="text-center mt-4 fw-light">
                Project for Pemrograman Visual by Group 9
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="<?=site_url('assets/vendors/js/vendor.bundle.base.js');?>"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="<?=site_url('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js');?>"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="<?=site_url('assets/js/off-canvas.js');?>"></script>
  <script src="<?=site_url('assets/js/hoverable-collapse.js');?>"></script>
  <script src="<?=site_url('assets/js/template.js');?>"></script>
  <script src="<?=site_url('assets/js/settings.js');?>"></script>
  <script src="<?=site_url('assets/js/todolist.js');?>"></script>
  <!-- endinject -->
</body>

</html>
