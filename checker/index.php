<?php
require '../checker/php/function.php';
session_start();
if (empty($_SESSION['iduser'])) {
  echo "<script>
    alert('Maaf Anda Belum Login');
    window.location.assign('../../login.php');
    </script>";
}
if ($_SESSION['role'] != 'checker') {
  echo "<script>
    alert('Maaf Anda Bukan Sesi checker');
    window.location.assign('../../login.php');
    </script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/mirorim.png">
  <link rel="icon" type="image/png" href="../assets/img/mirorim.png">
  <title>
    Mirorim Store
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href=".././assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href=".././assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href=".././assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link rel="stylesheet" type="text/css" href="../assets/DataTables/datatables.css">
  <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
  <link id="pagestyle" href=".././assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
  <link rel="stylesheet" href="style.css">
  <link href="path_to_bootstrap.css" rel="stylesheet">
  <style>
    .zoomable {
      width: 100px;
    }
    .zoomable:hover {
      transform: scale(2.8);
      transition: 0.3s ease;
    }
  </style>
</head>
<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="#" target="_blank">
        <img src="../assets/img/mirorim.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">Mirorim Inventory</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link <?php echo ($_GET['url'] === '') ? 'active' : ''; ?>" href="index.php?url=">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Task DS</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo ($_GET['url'] === 'product') ? 'taskds' : ''; ?>" href="index.php?url=taskds">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-check-square text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Task DS</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo ($_GET['url'] === 'product') ? 'product' : ''; ?>" href="index.php?url=product">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-box text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Product Toko</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo ($_GET['url'] === 'scanitem') ? 'scanitem' : ''; ?>" href="index.php?url=scanitem">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-box text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Scan Item</span>
          </a>
        </li>
      </ul>
    </div>
    </li>
    </ul>
    </div>
    <div class="sidenav-footer mx-3">
      <div class="card card-plain shadow-none" id="sidenavCard">
      <img class="w-50 mx-auto" src="../assets/img/mirorim.png" alt="sidebar_illustration">
        <div class="card-body text-center p-3 w-100 pt-0">
          <div class="docs-info">
          <h6 class="mb-0">Role : <?= $_SESSION['role']; ?></h6>
            <p class="text-xs font-weight-bold mb-0">Name : <?= $_SESSION['nama_user']; ?></p>
          </div>
        </div>
      </div>
    </div>
  </aside>
  <main class="main-content position-relative border-radius-lg ">
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Dashboard</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Dashboard</h6>
        </nav>
        <form id="myForm" method="post" action="">
          <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
              <div class="input-group">
                <span class="input-group-text text-body"><button style="border: 0px solid;" type="submit"><i class="fas fa-search" aria-hidden="true"></i></button></span>
                <input type="text" class="form-control" name="sku" id="skuInput" placeholder="Type SKU or Name here...">
              </div>
            </div>
            <ul class="navbar-nav  justify-content-end">
              <li class="nav-item d-flex align-items-center">
                <a href="#" class="nav-link text-white font-weight-bold px-0" onclick="confirmLogout()">
                  <i class="fa fa-door-open me-sm-1"></i>
                  <span class="d-sm-inline d-none">Log Out</span>
                </a>
              </li>
              <script>
                function confirmLogout() {
                  var logoutConfirmed = confirm("Yakin Mau Logout?");
                  if (logoutConfirmed) {
                    window.location.href = "../../logout.php";
                  }
                }
              </script>
              <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                  <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line bg-white"></i>
                    <i class="sidenav-toggler-line bg-white"></i>
                    <i class="sidenav-toggler-line bg-white"></i>
                  </div>
                </a>
              </li>
              <li class="nav-item dropdown px-3 d-flex align-items-center">
                <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-bell cursor-pointer"></i>
                </a>
              </li>
            </ul>
          </div>
        </form>
      </div>
    </nav>
    <div class="container-fluid py-4">
      <!-- End Navbar -->
      <?php
      $file = @$_GET['url'];
      if (empty($file)) {
        echo '
    <div class="row">
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">Today Money</p>
                  <h5 class="font-weight-bolder">
                    $53,000
                  </h5>
                  <p class="mb-0">
                    <span class="text-success text-sm font-weight-bolder">+55%</span>
                    since yesterday
                  </p>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                  <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">Today Users</p>
                  <h5 class="font-weight-bolder">
                    2,300
                  </h5>
                  <p class="mb-0">
                    <span class="text-success text-sm font-weight-bolder">+3%</span>
                    since last week
                  </p>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                  <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">New Clients</p>
                  <h5 class="font-weight-bolder">
                    +3,462
                  </h5>
                  <p class="mb-0">
                    <span class="text-danger text-sm font-weight-bolder">-2%</span>
                    since last quarter
                  </p>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                  <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">Sales</p>
                  <h5 class="font-weight-bolder">
                    $103,430
                  </h5>
                  <p class="mb-0">
                    <span class="text-success text-sm font-weight-bolder">+5%</span> than last month
                  </p>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                  <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-lg-7 mb-lg-0 mb-4">
        <div class="card z-index-2 h-100">
          <div class="card-header pb-0 pt-3 bg-transparent">
            <h6 class="text-capitalize">Sales overview</h6>
            <p class="text-sm mb-0">
              <i class="fa fa-arrow-up text-success"></i>
              <span class="font-weight-bold">4% more</span> in 2021
            </p>
          </div>
          <div class="card-body p-3">
            <div class="chart">
              <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="card card-carousel overflow-hidden h-100 p-0">
          <div id="carouselExampleCaptions" class="carousel slide h-100" data-bs-ride="carousel">
            <div class="carousel-inner border-radius-lg h-100">
              <div class="carousel-item h-100 active" style="background-image: url("./assets/img/carousel-1.jpg");
    background-size: cover;">
                <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                  <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                    <i class="ni ni-camera-compact text-dark opacity-10"></i>
                  </div>
                  <h5 class="text-white mb-1">Get started with Argon</h5>
                  <p>There�s nothing I really wanted to do in life that I wasn�t able to get good at.</p>
                </div>
              </div>
              <div class="carousel-item h-100" style="background-image: url("./assets/img/carousel-2.jpg");
    background-size: cover;">
                <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                  <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                    <i class="ni ni-bulb-61 text-dark opacity-10"></i>
                  </div>
                  <h5 class="text-white mb-1">Faster way to create web pages</h5>
                  <p>That�s my skill. I�m not really specifically talented at anything except for the ability to learn.</p>
                </div>
              </div>
              <div class="carousel-item h-100" style="background-image: url("./assets/img/carousel-3.jpg");
    background-size: cover;">
                <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                  <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                    <i class="ni ni-trophy text-dark opacity-10"></i>
                  </div>
                  <h5 class="text-white mb-1">Share with us your design tips!</h5>
                  <p>Don�t be afraid to be wrong because you can�t learn anything from a compliment.</p>
                </div>
              </div>
            </div>
            <button class="carousel-control-prev w-5 me-3" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next w-5 me-3" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-lg-7 mb-lg-0 mb-4">
        <div class="card ">
          <div class="card-header pb-0 p-3">
            <div class="d-flex justify-content-between">
              <h6 class="mb-2">Sales by Country</h6>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center ">
              <tbody>
                <tr>
                  <td class="w-30">
                    <div class="d-flex px-2 py-1 align-items-center">
                      <div>
                        <img src="./assets/img/icons/flags/US.png" alt="Country flag">
                      </div>
                      <div class="ms-4">
                        <p class="text-xs font-weight-bold mb-0">Country:</p>
                        <h6 class="text-sm mb-0">United States</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="text-center">
                      <p class="text-xs font-weight-bold mb-0">Sales:</p>
                      <h6 class="text-sm mb-0">2500</h6>
                    </div>
                  </td>
                  <td>
                    <div class="text-center">
                      <p class="text-xs font-weight-bold mb-0">Value:</p>
                      <h6 class="text-sm mb-0">$230,900</h6>
                    </div>
                  </td>
                  <td class="align-middle text-sm">
                    <div class="col text-center">
                      <p class="text-xs font-weight-bold mb-0">Bounce:</p>
                      <h6 class="text-sm mb-0">29.9%</h6>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="w-30">
                    <div class="d-flex px-2 py-1 align-items-center">
                      <div>
                        <img src="./assets/img/icons/flags/DE.png" alt="Country flag">
                      </div>
                      <div class="ms-4">
                        <p class="text-xs font-weight-bold mb-0">Country:</p>
                        <h6 class="text-sm mb-0">Germany</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="text-center">
                      <p class="text-xs font-weight-bold mb-0">Sales:</p>
                      <h6 class="text-sm mb-0">3.900</h6>
                    </div>
                  </td>
                  <td>
                    <div class="text-center">
                      <p class="text-xs font-weight-bold mb-0">Value:</p>
                      <h6 class="text-sm mb-0">$440,000</h6>
                    </div>
                  </td>
                  <td class="align-middle text-sm">
                    <div class="col text-center">
                      <p class="text-xs font-weight-bold mb-0">Bounce:</p>
                      <h6 class="text-sm mb-0">40.22%</h6>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="w-30">
                    <div class="d-flex px-2 py-1 align-items-center">
                      <div>
                        <img src="./assets/img/icons/flags/GB.png" alt="Country flag">
                      </div>
                      <div class="ms-4">
                        <p class="text-xs font-weight-bold mb-0">Country:</p>
                        <h6 class="text-sm mb-0">Great Britain</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="text-center">
                      <p class="text-xs font-weight-bold mb-0">Sales:</p>
                      <h6 class="text-sm mb-0">1.400</h6>
                    </div>
                  </td>
                  <td>
                    <div class="text-center">
                      <p class="text-xs font-weight-bold mb-0">Value:</p>
                      <h6 class="text-sm mb-0">$190,700</h6>
                    </div>
                  </td>
                  <td class="align-middle text-sm">
                    <div class="col text-center">
                      <p class="text-xs font-weight-bold mb-0">Bounce:</p>
                      <h6 class="text-sm mb-0">23.44%</h6>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="w-30">
                    <div class="d-flex px-2 py-1 align-items-center">
                      <div>
                        <img src="./assets/img/icons/flags/BR.png" alt="Country flag">
                      </div>
                      <div class="ms-4">
                        <p class="text-xs font-weight-bold mb-0">Country:</p>
                        <h6 class="text-sm mb-0">Brasil</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="text-center">
                      <p class="text-xs font-weight-bold mb-0">Sales:</p>
                      <h6 class="text-sm mb-0">562</h6>
                    </div>
                  </td>
                  <td>
                    <div class="text-center">
                      <p class="text-xs font-weight-bold mb-0">Value:</p>
                      <h6 class="text-sm mb-0">$143,960</h6>
                    </div>
                  </td>
                  <td class="align-middle text-sm">
                    <div class="col text-center">
                      <p class="text-xs font-weight-bold mb-0">Bounce:</p>
                      <h6 class="text-sm mb-0">32.14%</h6>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="card">
          <div class="card-header pb-0 p-3">
            <h6 class="mb-0">Categories</h6>
          </div>
          <div class="card-body p-3">
            <ul class="list-group">
              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex align-items-center">
                  <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                    <i class="ni ni-mobile-button text-white opacity-10"></i>
                  </div>
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">Devices</h6>
                    <span class="text-xs">250 in stock, <span class="font-weight-bold">346+ sold</span></span>
                  </div>
                </div>
                <div class="d-flex">
                  <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i class="ni ni-bold-right" aria-hidden="true"></i></button>
                </div>
              </li>
              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex align-items-center">
                  <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                    <i class="ni ni-tag text-white opacity-10"></i>
                  </div>
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">Tickets</h6>
                    <span class="text-xs">123 closed, <span class="font-weight-bold">15 open</span></span>
                  </div>
                </div>
                <div class="d-flex">
                  <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i class="ni ni-bold-right" aria-hidden="true"></i></button>
                </div>
              </li>
              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex align-items-center">
                  <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                    <i class="ni ni-box-2 text-white opacity-10"></i>
                  </div>
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">Error logs</h6>
                    <span class="text-xs">1 is active, <span class="font-weight-bold">40 closed</span></span>
                  </div>
                </div>
                <div class="d-flex">
                  <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i class="ni ni-bold-right" aria-hidden="true"></i></button>
                </div>
              </li>
              <li class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                <div class="d-flex align-items-center">
                  <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                    <i class="ni ni-satisfied text-white opacity-10"></i>
                  </div>
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">Happy users</h6>
                    <span class="text-xs font-weight-bold">+ 430</span>
                  </div>
                </div>
                <div class="d-flex">
                  <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i class="ni ni-bold-right" aria-hidden="true"></i></button>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>';
      } else {
        include $file . '.php';
      }
      ?>
      <footer class="footer pt-3  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                � <script>
                  document.write(new Date().getFullYear())
                </script>,
                made with <i class="fa fa-heart"></i> by
                <a href="https://instagram.com/sstrmdn" class="font-weight-bold" target="_blank">IT Support Mirorim</a>
                for a better web.
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src=".././assets/js/core/popper.min.js"></script>
  <script src=".././assets/js/core/bootstrap.min.js"></script>
  <script src=".././assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src=".././assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src=".././assets/js/plugins/chartjs.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../assets/DataTables/datatables.min.js"></script>
  <script>
    var ctx1 = document.getElementById("chart-line").getContext("2d");
    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);
    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
    new Chart(ctx1, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Mobile apps",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#5e72e4",
          backgroundColor: gradientStroke1,
          borderWidth: 3,
          fill: true,
          data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
          maxBarThickness: 6
        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#fbfbfb',
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#ccc',
              padding: 20,
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });
  </script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <script>
    $(document).ready(function() {
      $('#myTable').DataTable({
        "paging": true, // Enable pagination
        "pageLength": 10, // Number of rows per page
        "lengthMenu": [10, 25, 50, 100], // Options for number of rows per page
      });
    });
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src=".././assets/js/argon-dashboard.min.js?v=2.0.4"></script>
  <script>
    // JavaScript code
    // Function to initialize the DataTable
    function initializeDataTable() {
      if (!$.fn.DataTable.isDataTable('#myTable')) {
        const dataTable = $('#myTable').DataTable({
          // Add your DataTable initialization options here
        });
        // Handle pagination events
        dataTable.on('page.dt', function() {
          showMobileCards();
        });
      }
    }
    // Function to handle card clicks
    function handleCardClick(event) {
      event.preventDefault();
      // Add your logic here for card click event
    }
    // Function to show mobile cards based on pagination
    function showMobileCards() {
      const startIndex = (mobileCurrentPage - 1) * mobileItemsPerPage;
      const endIndex = startIndex + mobileItemsPerPage;
      $('#mobileCardContainer .card').hide();
      $('#mobileCardContainer .card').slice(startIndex, endIndex).show();
    }
    // Variables to track pagination state
    let mobileCurrentPage = 1;
    const mobileItemsPerPage = 10; // Number of items to show per page
    // Check the viewport width and show/hide elements based on screen size
    function updateLayout() {
      const desktopTableContainer = document.getElementById('desktopTableContainer');
      const mobileCardContainer = document.getElementById('mobileCardContainer');
      if (window.innerWidth < 1080 && window.innerHeight < 900) {
        desktopTableContainer.style.display = 'none';
        mobileCardContainer.classList.remove('d-none');
        // Initialize DataTable
        initializeDataTable();
        showMobileCards();
      } else {
        desktopTableContainer.style.display = 'block';
        mobileCardContainer.classList.add('d-none');
        // Destroy DataTable
        if ($.fn.DataTable.isDataTable('#myTable')) {
          $('#myTable').DataTable().destroy();
        }
      }
    }
    // Initial layout update on page load
    updateLayout();
    // Listen for window resize events and update layout accordingly
    window.addEventListener('resize', updateLayout);
    // Handle mobile pagination events
    $('#mobilePreviousPage').click(function(event) {
      event.preventDefault();
      if (!$(this).hasClass('disabled')) {
        mobileCurrentPage--;
        showMobileCards();
      }
    });
    $('#mobileNextPage').click(function(event) {
      event.preventDefault();
      if (!$(this).hasClass('disabled')) {
        mobileCurrentPage++;
        showMobileCards();
      }
    });
    // Attach click event listeners to each card
    const cards = document.querySelectorAll('#mobileCardContainer .card');
    cards.forEach(function(card) {
      card.addEventListener('click', handleCardClick);
    });
  </script>
  <script>
    // Function to handle box link click
    function handleBoxLinkClick(event) {
      event.preventDefault();
      // Add your logic here for the box link click event
      // For example:
      window.location.href = 'index.php?url=box';
    }
    // Function to handle add item link click
    function handleAddItemLinkClick(event) {
      event.preventDefault();
      // Add your logic here for the add item link click event
      // For example:
      alert("Add item link clicked");
    }
    // Function to handle mutasi link click
    function handleMutasiLinkClick(event) {
      event.preventDefault();
      // Add your logic here for the mutasi link click event
      // For example:
      alert("Mutasi link clicked");
    }
    // Attach click event listener to the edit links
    var editLinks = document.getElementsByClassName('edit-link');
    for (var i = 0; i < editLinks.length; i++) {
      editLinks[i].addEventListener('click', handleEditLinkClick);
    }
    // Function to handle edit link click
    function handleEditLinkClick(event) {
      event.preventDefault();
      // Get the id_product from the data-id attribute
      var idProduct = this.getAttribute('data-id');
      // Add your logic here for the edit link click event
      // For example:
      window.location.href = 'index.php?url=edit&idp=' + idProduct;
    }
    var boxDetail = document.getElementsByClassName('box-detail');
    for (var i = 0; i < boxDetail.length; i++) {
      boxDetail[i].addEventListener('click', handleBoxDetailClick);
    }
    // Function to handle edit link click
    function handleBoxDetailClick(event) {
      event.preventDefault();
      // Get the id_product from the data-id attribute
      var idBox = this.getAttribute('data-id');
      // Add your logic here for the edit link click event
      // For example:
      window.location.href = 'index.php?url=boxdetail&idb=' + idBox;
    }
    // Attach click event listeners to the links
    document.getElementById('boxLink').addEventListener('click', handleBoxLinkClick);
    document.getElementById('addItemLink').addEventListener('click', handleAddItemLinkClick);
    document.getElementById('mutasiLink').addEventListener('click', handleMutasiLinkClick);
    document.getElementById('detailBoxLink').addEventListener('click', handledetailBoxLinkClick);
  </script>
  <script>
    function toggleNama(index) {
      var nama = document.getElementById('nama' + index);
      var toggler = document.getElementById('toggler' + index);
      if (nama.textContent === nama.dataset.short) {
        nama.textContent = nama.dataset.full;
        toggler.textContent = '<';
      } else {
        nama.textContent = nama.dataset.short;
        toggler.textContent = '>';
      }
    }
    // Attach click event listener to the edit links
    var editLinks = document.getElementsByClassName('edit-link');
    for (var i = 0; i < editLinks.length; i++) {
      editLinks[i].addEventListener('click', handleEditLinkClick);
    }
    function handleEditLinkClick(event) {
      event.preventDefault();
      // Get the id_product from the data-id attribute
      var idProduct = this.getAttribute('data-id');
      var idProductDua = this.getAttribute('data-it');
      // Add your logic here for the edit link click event
      // For example:
      window.location.href = 'index.php?url=edit&idt=' + idProduct + '&idp=' + idProductDua;
    }
  </script>
  <script>
    // Ambil referensi ke elemen formulir dan input SKU
    const form = document.getElementById('myForm');
    const skuInput = document.getElementById('skuInput');
    // Fungsi untuk mendapatkan nilai dari parameter "url"
    function getUrlParameter(name) {
      name = name.replace(/[\[\]]/g, "\\$&");
      var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)");
      var results = regex.exec(window.location.href);
      if (!results) return null;
      if (!results[2]) return '';
      return decodeURIComponent(results[2].replace(/\+/g, " "));
    }
    // Fungsi untuk mengubah nilai action formulir berdasarkan input SKU dan "product" dari parameter "url"
    function updateFormAction(event) {
      event.preventDefault(); // Mencegah formulir submit secara default
      const skuValue = skuInput.value; // Mendapatkan nilai dari input SKU
      const productValue = getUrlParameter('url'); // Mendapatkan "product" dari parameter "url"
      // Buat URL sesuai dengan "product" dari parameter "url" dan SKU yang dimasukkan
      const newAction = `?url=${productValue}&sku=${skuValue}`;
      form.action = newAction;
      form.submit(); // Melakukan submit formulir dengan action baru
    }
    // Tambahkan event listener untuk submit pada formulir
    form.addEventListener('submit', updateFormAction);
  </script>
</body>
</html>