<!--
=========================================================
* BLK Raffle System- v1.0.0
=========================================================

* Product Page: https://www.creative-tim.com/product/blk-design-system
* Copyright 2019 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Landing Page • Raffle System by Neil Francis Bayna</title>
  <?php include './layout/Head.php'; ?>
</head>

<body class="index-page">
  <!-- Navbar -->
  <?php include './layout/Navbar.php'; ?>
  <!-- End Navbar -->




  <div class="wrapper">
    <!-- Header -->
    <div class="page-header header-filter">
      <div class="squares square1"></div>
      <div class="squares square2"></div>
      <div class="squares square3"></div>
      <div class="squares square4"></div>
      <div class="squares square5"></div>
      <div class="squares square6"></div>
      <div class="squares square7"></div>
      <div class="container">
        <div class="content-center brand">
          <h1 class="h1-seo">COACCIDENCE•</h1>
          <h3>What a COACCIDENCE! Raffle System.</h3>
          <a href="./spin.php" class="btn btn-primary btn-simple btn-round">Go Spin</a>
        </div>
      </div>
    </div>
    <!-- End Header -->

    <!-- MAIN CONTENT HERE -->



    <!-- Footer -->
    <?php include './layout/Footer.php'; ?>
    <!-- End Footer -->
  </div>
  <!--   Core JS Files   -->
  <?php include './layout/Scripts.php'; ?>

  <!-- Neil Francis Bayna JS -->
  <script>
    $(function () {
      let anchor = $('body').find('a');
      anchor.each(function () {
        if ($(this).attr('href') == '#') {
          $(this).attr('href', 'javascript:void(0)');
        }
      });
    });
  </script>
</body>

</html>