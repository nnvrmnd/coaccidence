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
  <title>Control Panel • Raffle System by Neil Francis Bayna</title>
  <?php include './layout/Head.php'; ?>

  <style>
    .modal-snoop {
      background-color: #171940;
    }

    .modal-snoop-content {
      background-color: #ebebeb !important;
    }
  </style>
</head>

<body class="index-page">
  <!-- Navbar -->
  <?php include './layout/Navbar.php'; ?>
  <!-- End Navbar -->



  <div class="wrapper">
    <!-- MAIN CONTENT HERE -->
    <div class="section section-tabs">
      <div class="container">
        <div class="title">
          <h3 class="mb-3">Roulette</h3>
        </div>

        <!-- Inputs row -->
        <div class="row">
          <div class="col-md-10 ml-auto col-xl-12 mr-auto">
            <div id="inputs">
              <div class="row">
                <!-- Clear list -->
                <div class="col-md-5 ml-auto col-lg-3 pr-0">
                  <div class="form-group">
                    <button class="btn btn-sm btn-danger btn-link btn-icon btn-simple float-right mr-0 d-none"
                      id="clear_list" data-toggle="tooltip" data-placement="bottom" title="Clear player list"
                      data-container="body" data-animation="true">
                      <i class="tim-icons icon-simple-remove"></i>
                    </button>
                  </div>
                </div>
                <!-- Qty -->
                <div class="col-md-5 col-lg-3">
                  <div class="form-group">
                    <input type="number" class="form-control" id="spinlist_qty" placeholder="Number of players"></input>
                  </div>
                </div>
                <!-- List bar -->
                <div class="col-md-5 col-lg-3">
                  <div class="form-group">
                    <select class="form-control" id="spinlist_select"></select>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-10 ml-auto col-xl-12 mr-auto">
            <div id="inputs">
              <div class="row">
                <!-- Buttons -->
                <div class="col-md-5 col-lg-12">
                  <div class="form-group">
                    <button class="btn btn-lg btn-primary btn-block btn-round font-weight-bold py-3" id="spin_btn"
                      data-toggle="tooltip" data-placement="bottom" title="Spin the roulette" data-container="body"
                      data-animation="true">
                      S&ensp;P&ensp;I&ensp;N
                    </button>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

        <!-- Table row -->
        <div class="row">
          <div class="col-md-10 ml-auto col-xl-12 mr-auto">

            <div class="card">
              <div class="card-header">
                <ul class="nav nav-tabs nav-tabs-primary" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#link1" role="tablist">
                      Players
                    </a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <!-- Tab panes -->
                <div class="tab-content tab-space">
                  <div class="tab-pane active" id="link1">
                    <!-- Table -->
                    <table class="table" id="">
                      <thead class="text-primary">
                        <tr>
                          <th>Name</th>
                          <th>Status</th>
                          <th class="text-right">Actions</th>
                        </tr>
                      </thead>
                      <tbody id="player_list">
                        <!-- <tr>
                          <td></td>
                          <td><i>List is empty...</i></td>
                          <td class="text-right"></td>
                        </tr> -->
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Tabs on plain Card -->
          </div>
        </div>
      </div>
    </div>



    <!-- Modal -->
    <!-- Snoop -->
    <div class="modal fade modal-snoop" id="SpinModal" tabindex="-1" role="dialog" aria-labelledby="SpinModalLabel"
      aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog modal-lg">
        <div class="modal-content modal-snoop-content">
          <div class="modal-body justify-content-center">
            <center>
              <img src="./assets/img/snoop.gif" class="py-5" style="height:50%">
            </center>
          </div>
        </div>
      </div>
    </div>
    <!-- End Modal -->

    <!-- Footer -->
    <?php include './layout/Footer.php'; ?>
    <!-- End Footer -->
  </div>
  <!--   Core JS Files   -->
  <?php include './layout/Scripts.php'; ?>

  <!-- Neil Francis Bayna JS -->
  <script>
    $(function() {
      let anchor = $('body').find('a');
      anchor.each(function() {
        if ($(this).attr('href') == '#') {
          $(this).attr('href', 'javascript:void(0)');
        }
      });
    });
  </script>
</body>

</html>