<?php 
  session_start();

  if (!isset($_SESSION['log']) === true) {
    header('Location: auth.php');
  } else {
?>
<!DOCTYPE html>
<html>

<head>
  <title>Inventaris Lembaga</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap.min.css" />
  <link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/fixedheader/3.2.0/css/fixedHeader.bootstrap.min.css" />
  <link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <style>
    html,body,h1,h2,h3,h4,h5 
    {
      font-family: "Raleway", sans-serif
    }
    #preload {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.7);
      z-index: 9999;
    }
  </style>
</head>

<body class="w3-light-grey">

  <!-- Preload Spinner -->
  <div id="preload" class="w3-display-container">
    <div class="w3-display-middle">
      <div class="w3-container w3-center">
        <div class="w3-spin w3-text-white" style="font-size: 80px">&#9748;</div>
        <h2 class="w3-text-white">Loading...</h2>
      </div>
    </div>
  </div>

  <!-- Top container -->
  <div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
    <button class="w3-bar-item w3-button w3-hover-none w3-hide-large w3-hover-text-light-grey w3-padding-16" onclick="w3_open();"><i class="fa fa-bars"></i></button>
    <h4 class="w3-bar-item"><b>INVENTARIS LEMBAGA</b></h4>
    <span class="w3-bar-item w3-right"><img class="w3-circle" src="assets/img/user/avatar3.png" alt="Logo here" width="40em"></span>
  </div>

  <!-- Sidebar/menu -->
  <nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
    <div class="w3-container w3-row">
      <div class="w3-col s4">
        <img src="assets/img/user/avatar3.png" class="w3-circle w3-margin-right" style="width:46px">
      </div>
      <div class="w3-col s8 w3-bar">
        <span>Welcome, <strong>Admin</strong></span><br>
      </div>
    </div>
    <hr>
    <div class="w3-container">
      <h5 class="w3-show-inline-block w3-amber w3-padding-small">Anggota</h5>
    </div>
    <hr>
    <div class="w3-bar-block">
      <a href="#" class="w3-bar-item w3-button w3-hide-large w3-padding-16 w3-dark-grey w3-hover-black"
        onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
      <a href="beranda.php" class="w3-bar-item w3-button w3-padding"><i class="fas fa-solid fa-chart-line fa-fw"></i>  Beranda</a>
      <a href="pinjam_anggota.php" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fas fa-user fa-fw"></i> Peminjaman  Anggota</a>
      <a href="pinjam_lembaga.php" class="w3-bar-item w3-button w3-padding"><i class="fas fa-users fa-fw"></i> Peminjaman Lembaga</a>
      <a href="kembali_anggota.php" class="w3-bar-item w3-button w3-padding"><i class="fas fa-user fa-fw"></i> Pengembalian Anggota</a>
      <a href="kembali_lembaga.php" class="w3-bar-item w3-button w3-padding"><i class="fas fa-users fa-fw"></i> Pengembalian Lembaga</a>
      <a href="logout.php" class="w3-bar-item w3-button w3-padding">Logout</a>
    </div>
  </nav>


  <!-- Overlay effect when opening sidebar on small screens -->
  <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer"
    title="close side menu" id="myOverlay"></div>

  <!-- !PAGE CONTENT! -->
  <div class="w3-main" style="margin-left:300px;margin-top:43px;">

    <!-- Header -->
    <header class="w3-container" style="padding-top:22px">
      <h5><i class="fas fa-user"></i> Daftar Peminjaman Barang / <b>Anggota</b></h5>
    </header>

    <div class="w3-panel">
      <div class="w3-row-padding" style="margin:0 -16px">

        <!-- Peminjam Anggota -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <h3 class="text-center mb-4">Daftar Peminjaman Barang - Anggota</h3>
          <h4 class="text-center mb-4" id="packageName"></h4>
          <br />
          <a href="https://docs.google.com/forms/d/e/1FAIpQLSebKaCLqlFCPUyBuKxidHkOHKTX2B9tBbg259F-k3rj-19ApQ/viewform?usp=sf_link"
          type="button" class="btn btn-primary mt-3 mb-3" target="_blank"><i class="fas fa-solid fa-hand-holding-medical"></i> &nbsp;&nbsp;<b>Pinjam Barang</b></a>
          <a href="https://docs.google.com/forms/d/e/1FAIpQLSd1k7T3F1wqjI5dfOHNevPX4eDXBifpoRh1WB_bLW3hpgXxfw/viewform?usp=sf_link"
          type="button" class="btn btn-warning mt-3 mb-3 ml-2" target="_blank"><i class="fas fa-solid fa-hand-holding"></i> &nbsp;&nbsp;<b>Kembalikan
          Barang</b></a>
          <br />
          <br />
          <table id="anggota" class="table table-striped table-bordered mt-2 mb-2" style="width: 100%"></table>
          <br />
          <br />
          <p id="passingGrade"></p>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <footer class="w3-container w3-padding-16 w3-light-grey">
      <h4>Inventaris Lembaga</h4>
      <p><i>Copyright</i> 2023. Powered by <b>Inventaris</b></p>
    </footer>

    <!-- End page content -->
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/fixedheader/3.2.0/js/dataTables.fixedHeader.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

  <script>
    // Preload Spinner
    var preload = document.getElementById("preload");
    // Open Spinner
    function showPreload() {
      preload.style.display = "inline-block";
    }
    //Close Spinner
    function hidePreload() {
      preload.style.display = "none";
    }

    // Get the Sidebar
    var mySidebar = document.getElementById("mySidebar");

    // Get the DIV with overlay effect
    var overlayBg = document.getElementById("myOverlay");

    // Toggle between showing and hiding the sidebar, and add overlay effect
    function w3_open() {
      if (mySidebar.style.display === 'block') {
        mySidebar.style.display = 'none';
        overlayBg.style.display = "none";
      } else {
        mySidebar.style.display = 'block';
        overlayBg.style.display = "block";
      }
    }

    // Close the sidebar with the close button
    function w3_close() {
      mySidebar.style.display = "none";
      overlayBg.style.display = "none";
    }

    // Data tables

    //pinjam anggota
    $(document).ready(function () {
      showPreload();
      
      $("#anggota").DataTable({
        ajax: "https://script.googleusercontent.com/macros/echo?user_content_key=7RiX-b-05SbyDW6WQVNHXYYQAmuB5BEYBATzl-qS5jyELsQYtxlPUGX_fV34OtYucbz0N9As9W46lCPvDHQ_cxLS7JEmRRT0m5_BxDlH2jW0nuo2oDemN9CCS2h10ox_1xSncGQajx_ryfhECjZEnPskVDJYMB_FgcIgaPnT92soCffQHU2iTyFXZkfdTEelp0Yi_Y0h05bkWInaTuFE43dwqzgrLEnvpBLWX9WPzbrRb12d39FWuw&lib=MTJLpWWkfGM24GAye8H78qyp_LA-TDJCx",
        columns: [
        {
            title: "No.",
            data: null,
            render: function (data, type, row, meta) {
            // Menghasilkan nomor increment berdasarkan indeks baris (dimulai dari 1)
            return meta.row + 1;
            },
        },  
        {
            title: "Nama Lengkap",
            data: "Nama Lengkap",
          },
          {
            title: "Jabatan Peminjam",
            data: "Jabatan Peminjam",
          },
          {
            title: "Nomor WhatsApp Peminjam",
            data: "Nomor WhatsApp Peminjam",
          },
          {
            title: "Barang Inventaris yang dipinjam",
            data: "Barang Inventaris yang dipinjam",
          },
          {
            title: "jumlah",
            data: "jumlah",
          },
          {
            title: "Foto kondisi barang sebelum dipinjam",
            data: "Foto kondisi barang sebelum dipinjam",
          },
          {
            title: "Tanggal peminjaman",
            data: "Tanggal peminjaman",
            render: function (data) {
              var date = new Date(data);
              var options = {
                year: "numeric",
                month: "long",
                day: "numeric",
              };
              return date.toLocaleDateString("en-US", options);
            },
          },
          {
            title: "Estimasi tanggal pengembalian",
            data: "Estimasi tanggal pengembalian",
            render: function (data) {
              var date = new Date(data);
              var options = {
                year: "numeric",
                month: "long",
                day: "numeric",
              };
              return date.toLocaleDateString("en-US", options);
            },
          },
          {
            data: "Pernyataan Peminjam",
            title: "Pernyataan Peminjam",
          },
        ],
        rowId: "Tanggal peminjaman",
        liveAjax: true,
        initComplete: function () {
          hidePreload();
        },
      });
    });
  </script>

</body>

</html> 
<?php } ?>