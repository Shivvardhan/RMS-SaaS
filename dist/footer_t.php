  <?php
  require "dbcon.php";
  $stmt = $conn->prepare("SELECT l_token FROM `t_users` WHERE `username` = ?");
  
	$stmt->bind_param('s', $_SESSION['username']);
	$stmt->execute();
	$result = $stmt->get_result();
	$user = $result->fetch_assoc();
	if ($user['l_token'] == isset($_SESSION['token']) && isset($_SESSION['username']) && session_status() === PHP_SESSION_ACTIVE) {
        ?>
  <!--begin::Footer-->
  <div id="kt_app_footer" class="app-footer">
      <!--begin::Footer container-->
      <div class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
          <!--begin::Copyright-->
          <div class="text-dark order-2 order-md-1">
              <span class="text-muted fw-semibold me-1">2025 &copy;</span>
              <a href="" target="_blank" class="text-gray-800 text-hover-primary">System Vista - All Rights
                  Rsesrved.</a>
          </div>
          <!--end::Copyright-->
          <!--begin::Menu-->
          <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
              <li class="menu-item">
                  <a href="" target="_blank" class="menu-link px-2">Developed By &#x1F525; squadEAGLES</a>
              </li>

          </ul>
          <!--end::Menu-->
      </div>
      <!--end::Footer container-->
  </div>
  <!--end::Footer-->
  </div>
  <!--end:::Main-->
  </div>
  <!--end::Wrapper-->
  </div>
  <!--end::Page-->
  </div>
  <!--end::App-->

  <!--begin::Javascript-->
  <script>
var hostUrl = "assets/";
  </script>
  <!--begin::Global Javascript Bundle(mandatory for all pages)-->
  <script src="assets/plugins/global/plugins.bundle.js"></script>
  <script src="assets/js/scripts.bundle.js"></script>
  <!--end::Global Javascript Bundle-->
  <!--begin::Vendors Javascript(used for this page only)-->
  <script src="assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
  <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
  <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
  <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
  <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
  <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
  <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
  <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
  <script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
  <script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
  <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
  <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
  <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
  <!--end::Vendors Javascript-->
  <!--begin::Custom Javascript(used for this page only)-->
  <script src="assets/js/widgets.bundle.js"></script>
  <script src="assets/js/custom/apps/chat/chat.js"></script>
  <script src="assets/js/custom/utilities/modals/upgrade-plan.js"></script>
  <script src="assets/js/custom/utilities/modals/create-campaign.js"></script>
  <script src="assets/js/custom/utilities/modals/users-search.js"></script>
  <!--end::Custom Javascript-->
  <!--end::Javascript-->
  </body>
  <!--end::Body-->

  </html>

  <?php } 
   else{
    echo "<script>window.location.href = 'index.php'; </script>";
}?>