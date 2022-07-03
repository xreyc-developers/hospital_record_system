<?php
session_start();
include('assets/configs/config.php');
include('assets/configs/checklogin.php');
check_login();
$aid = $_SESSION['dept_id'];
if (isset($_GET['del'])) {
  $id = intval($_GET['del']);
  $adn = "delete from hospital_employees where em_id=?";
  $stmt = $mysqli->prepare($adn);
  $stmt->bind_param('i', $id);
  $stmt->execute();
  $stmt->close();
  $msg = "Employee Details Removed";
}
?>

<!DOCTYPE html>
<html lang="en">
<!--Header-->
<?php include('includes/header.php'); ?>
<!--End Header-->

<body>
  <div class="be-wrapper be-fixed-sidebar">
    <!--Navigation bar-->
    <?php include("includes/navbar.php"); ?>
    <!--Navigation-->

    <!--Sidebar-->
    <?php include("includes/sidebar.php"); ?>
    <!--Sidebar-->
    <div class="be-content">
      <div class="main-content container-fluid">
        <div class="row">
          <div class="col-12 col-lg-12">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="pages_dept_head_dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Registration Desk</a></li>
                <li class="breadcrumb-item active" aria-current="page">Manage Registration Desk Employee</li>
              </ol>
            </nav>
            <div class="card card-table">
              <div class="card-header">
                <div class="title">Manage Registration Desk Employees</div>
              </div>
              <?php if (isset($msg)) { ?>
                <script>
                  setTimeout(function() {
                      swal("Success!", "<?php echo $error; ?>!", "success");
                    },
                    100);
                </script>

              <?php } ?>
              <div class="card-body table-responsive">
                <table class="table table-striped table-borderless">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th style="width:20%;">Employee Name</th>
                      <th style="width:20%;">Email Address</th>
                      <th style="width:20%;">Mobile Number</th>
                      <th style="width:20%;">National ID No.</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <?php

                  $ret = "SELECT * FROM hospital_employees Where em_dept = 'Registration Desk' ";
                  $stmt = $mysqli->prepare($ret);
                  //$stmt->bind_param('i',$aid);
                  $stmt->execute(); //ok
                  $res = $stmt->get_result();
                  $cnt = 1;
                  while ($row = $res->fetch_object()) {
                  ?>
                    <tbody class="no-border-x">
                      <tr>
                        <td><?php echo $cnt; ?></td>
                        <td><?php echo $row->em_fname; ?> <?php echo $row->em_lname; ?></td>
                        <td><?php echo $row->em_email; ?></td>
                        <td><?php echo $row->em_phone; ?></td>
                        <td><?php echo $row->em_idno; ?></td>
                        <td><a href='admin_pages_manage_regdesk_employee.php?del=<?php echo $row->em_id; ?>' onClick="return confirm('Remove  This Record?');"><i class="mdi mdi-delete"></i></a>
                          <a href='admin_pages_manage_single_regdesk_employee.php?em_id=<?php echo $row->em_id; ?>'><i class="mdi mdi-check-circle"></i></a>
                          <a href='admin_pages_view_single_employee.php?em_id=<?php echo $row->em_id; ?>'><i class="mdi mdi-eye-check-outline"></i></a>
                        </td>
                      </tr>
                    </tbody>
                  <?php $cnt = $cnt + 1;
                  } ?>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <script src="assets/lib/jquery/jquery.min.js" type="text/javascript"></script>
  <script src="assets/lib/perfect-scrollbar/js/perfect-scrollbar.min.js" type="text/javascript"></script>
  <script src="assets/lib/bootstrap/dist/js/bootstrap.bundle.min.js" type="text/javascript"></script>
  <script src="assets/js/app.js" type="text/javascript"></script>
  <script src="assets/lib/jquery-flot/jquery.flot.js" type="text/javascript"></script>
  <script src="assets/lib/jquery-flot/jquery.flot.pie.js" type="text/javascript"></script>
  <script src="assets/lib/jquery-flot/jquery.flot.time.js" type="text/javascript"></script>
  <script src="assets/lib/jquery-flot/jquery.flot.resize.js" type="text/javascript"></script>
  <script src="assets/lib/jquery-flot/plugins/jquery.flot.orderBars.js" type="text/javascript"></script>
  <script src="assets/lib/jquery-flot/plugins/curvedLines.js" type="text/javascript"></script>
  <script src="assets/lib/jquery-flot/plugins/jquery.flot.tooltip.js" type="text/javascript"></script>
  <script src="assets/lib/jquery.sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
  <script src="assets/lib/countup/countUp.min.js" type="text/javascript"></script>
  <script src="assets/lib/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
  <script src="assets/lib/canvas/canvasjs.min.js"></script>
  <script src="assets/lib/canvas/jquery.canvasjs.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      //-initialize the javascript
      App.init();
      App.dashboard();

    });
  </script>
</body>

</html>