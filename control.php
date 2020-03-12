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
    .dummy {
      color: rgba(255, 255, 255, 0.8) !important;
      background-color: transparent !important;
      cursor: pointer !important;
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
          <h3 class="mb-3">Control Panel</h3>
        </div>

        <!-- Inputs row -->
        <div class="row">
          <div class="col-md-10 ml-auto col-xl-12 mr-auto">
            <div id="inputs">
              <div class="row">
                <!-- Buttons -->
                <div class="col-md-5 col-lg-3">
                  <div class="form-group ctrl_buttons d-none">
                    <button class="btn btn-sm btn-warning btn-link btn-icon btn-simple" id="reset_all"
                      data-toggle="tooltip" data-placement="bottom" title="Reset all status" data-container="body"
                      data-animation="true">
                      <i class="tim-icons icon-refresh-01"></i>
                    </button>
                    <button class="btn btn-sm btn-info btn-link btn-icon btn-simple" id="add_name" data-toggle="tooltip"
                      data-placement="bottom" title="Add new name/s" data-container="body" data-animation="true">
                      <i class="tim-icons icon-simple-add"></i>
                    </button>
                  </div>
                </div>
                <!-- Add list -->
                <div class="col-md-5 ml-auto col-lg-3 pr-0">
                  <div class="form-group">
                    <button class="btn btn-sm btn-danger btn-link btn-icon btn-simple float-right mr-0 d-none list_btn"
                      id="delete_list" data-toggle="tooltip" data-placement="bottom" title="Delete selected list"
                      data-container="body" data-animation="true">
                      <i class="tim-icons icon-simple-remove"></i>
                    </button>
                    <button class="btn btn-sm btn-success btn-link btn-icon btn-simple float-right mr-0" id="add_list"
                      data-toggle="tooltip" data-placement="bottom" title="Add new list" data-container="body"
                      data-animation="true">
                      <i class="tim-icons icon-simple-add"></i>
                    </button>
                    <button class="btn btn-sm btn-primary btn-link btn-icon btn-simple float-right mr-0 d-none"
                      id="refresh_list" data-toggle="tooltip" data-placement="bottom" title="Refresh list"
                      data-container="body" data-animation="true">
                      <i class="tim-icons icon-refresh-01"></i>
                    </button>
                  </div>
                </div>

                <!-- List bar -->
                <div class="col-md-5 col-lg-3">
                  <div class="form-group">
                    <select class="form-control" id="list_select"></select>
                  </div>
                </div>

                <!-- Search bar -->
                <div class="col-md-5 col-lg-3">
                  <div class="form-group">
                    <input type="text" class="form-control" id="search_filter" placeholder="Search table..." disabled>
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
                      Names Table
                    </a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <!-- Tab panes -->
                <div class="tab-content tab-space">
                  <div class="tab-pane active" id="link1">
                    <!-- Table -->
                    <table class="table" id="names_table">
                      <thead class="text-primary">
                        <tr>
                          <th>Name</th>
                          <th>Status</th>
                          <th class="text-right">Actions</th>
                        </tr>
                      </thead>
                      <tbody id="names_list">
                        <tr>
                          <td></td>
                          <td><i>Please select a list above...</i></td>
                          <td class="text-right"></td>
                        </tr>
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
    <!-- Add new name -->
    <div class="modal fade modal-black new" id="NewNameModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
      aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header justify-content-center">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="tim-icons icon-simple-remove text-white"></i>
            </button>
            <div class="text-muted mr-auto">
              <h3 class="mb-0">New name/s</h3>
            </div>
          </div>
          <div class="modal-body">
            <form role="form" id="newname_form">
              <div class="form-group mb-3">
                <div class="input-group">
                  <input type="text" class="form-control form-control-lg" name="ngiven" autofocus
                    placeholder="Given name">
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <input type="text" class="form-control form-control-lg" name="nsurname" placeholder="Surname">
                </div>
              </div>
              <div class="">
                <button type="button" class="btn btn-info btn-link font-weight-bold my-4" id="up_csv"
                  data-toggle="tooltip" data-placement="bottom" title="Upload CSV file containing names"
                  data-container="body" data-animation="true">
                  Upload CSV
                </button>
                <a href="./namestemplate.csv" download="Names CSV Template [Coaccidence].csv"
                  class="btn btn-info btn-link font-weight-bold" data-toggle="tooltip" data-placement="bottom"
                  title="Download CSV file template" data-container="body" data-animation="true">CSV Template</a>
                <div class="float-right">
                  <button type="submit" class="btn btn-primary btn-round font-weight-bold my-4">ADD</button>
                  <button type="button" class="btn btn-neutral btn-round text-dark font-weight-bold px-3"
                    data-dismiss="modal" aria-hidden="true">Cancel</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Add list -->
    <div class="modal fade modal-black new" id="NewListModal" tabindex="-1" role="dialog"
      aria-labelledby="NewListModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header justify-content-center">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="tim-icons icon-simple-remove text-white"></i>
            </button>
            <div class="text-muted mr-auto">
              <h3 class="mb-0">New list</h3>
            </div>
          </div>
          <div class="modal-body">
            <form role="form" id="newlist_form">
              <div class="form-group mb-3">
                <div class="input-group">
                  <input type="text" class="form-control form-control-lg" name="title" autofocus
                    placeholder="List name">
                </div>
                <small class="title"></small>
              </div>
              <div class="float-right">
                <button type="submit" class="btn btn-primary btn-round font-weight-bold my-4">ADD</button>
                <button type="button" class="btn btn-neutral btn-round text-dark font-weight-bold px-3"
                  data-dismiss="modal" aria-hidden="true">Cancel</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Upload csv -->
    <div class="modal fade modal-black new" id="CSVModal" tabindex="-1" role="dialog" aria-labelledby="CSVModalLabel"
      aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header justify-content-center">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="csv_exit">
              <i class="tim-icons icon-simple-remove text-white"></i>
            </button>
            <div class="text-muted mr-auto">
              <h3 class="mb-0">Upload CSV file</h3>
            </div>
          </div>
          <div class="modal-body">
            <form role="form" id="csv_form">
              <div class="form-group">
                <div class="input-group">
                  <input type="text" class="form-control form-control-lg dummy" id="dummy" name="dummy"
                    placeholder="Upload csv file, click here..." readonly>
                </div>
                <small class="csv"></small>
              </div>
              <input type="file" class="d-none" name="csv" name="csv" id="csv" accept=".csv">
              <div class="float-right">
                <button type="submit" class="btn btn-primary btn-round font-weight-bold my-4">UPLOAD</button>
                <button type="button" class="btn btn-neutral btn-round text-dark font-weight-bold px-3" id="csv_back"
                  data-dismiss="modal" aria-hidden="true">Back</button>
              </div>
            </form>
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