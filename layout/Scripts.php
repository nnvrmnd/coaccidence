<!-- Modals -->
<!-- Prompt -->
<div class="modal fade modal-warning alerts" id="PromptModal" tabindex="-1" role="dialog"
   aria-labelledby="PromptModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
               <i class="tim-icons icon-simple-remove"></i>
            </button>
            <h4 class="title title-up">&nbsp;</h4>
         </div>
         <div class="modal-body">
            <center>
               <h1><i class="fa fa-exclamation-triangle fa-3x" aria-hidden="true"></i>
                  <h1>
                     <h2 class="modal_msg" id="prompt-modal-msg"></h2>
            </center>

         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-warning btn-round font-weight-bold px-5" id="yes_prompt"
               data-dismiss="modal">YES</button>
            <button type="button" class="btn btn-neutral btn-round font-weight-bold text-dark"
               data-dismiss="modal">Cancel</button>
         </div>
      </div>
   </div>
</div>

<!-- Success -->
<div class="modal fade modal-info alerts" id="SuccessModal" tabindex="-1" role="dialog"
   aria-labelledby="SuccessModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
               <i class="tim-icons icon-simple-remove"></i>
            </button>
            <h4 class="title title-up">&nbsp;</h4>
         </div>
         <div class="modal-body">
            <center>
               <h1><i class="fa fa-check fa-3x" aria-hidden="true"></i>
                  <h3 class="mb-2 font-italic"><b>GREAT!</b></h3>
                  <h3 class="modal_msg" id="success-modal-msg"></h3>
            </center>

         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-neutral font-weight-bold text-dark px-3 float-right ml-auto"
               data-dismiss="modal">Ok, got it</button>
         </div>
      </div>
   </div>
</div>

<!-- Error -->
<div class="modal fade modal-danger alerts" id="ErrorModal" tabindex="-1" role="dialog"
   aria-labelledby="ErrorModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
               <i class="tim-icons icon-simple-remove"></i>
            </button>
            <h4 class="title title-up">&nbsp;</h4>
         </div>
         <div class="modal-body">
            <center>
               <h1><i class="fa fa-times fa-3x" aria-hidden="true"></i>
                  <h3 class="mb-2 font-italic"><b>OOPS!</b></h3>
                  <h3 class="modal_msg" id="error-modal-msg"></h3>
            </center>

         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-neutral btn-round font-weight-bold text-dark px-3 float-right ml-auto"
               data-dismiss="modal">Ok, got it</button>
         </div>
      </div>
   </div>
</div>
<!-- End Modals -->

<script src="./assets/js/core/jquery.min.js" type="text/javascript"></script>
<script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="./assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<script src="./assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="./assets/js/plugins/bootstrap-switch.js"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="./assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
<!-- Chart JS -->
<script src="./assets/js/plugins/chartjs.min.js"></script>
<!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
<script src="./assets/js/plugins/moment.min.js"></script>
<script src="./assets/js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
<!-- Black Dashboard DEMO methods, don't include it in your project! -->
<script src="./assets/demo/demo.js"></script>
<!-- Control Center for Black UI Kit: parallax effects, scripts for the example pages etc -->
<script src="./assets/js/blk-design-system.min.js?v=1.0.0" type="text/javascript"></script>
<script>
   function scrollToDownload() {
      if ($('.section-download').length != 0) {
         $("html, body").animate({
            scrollTop: $('.section-download').offset().top
         }, 1000);
      }
   }
</script>

<!-- Neil Francis Bayna JS -->
<script src="./assets/js/neil-francis-bayna.js"></script>