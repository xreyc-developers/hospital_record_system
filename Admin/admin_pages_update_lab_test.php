<?php
session_start();
include('assets/configs/config.php');
include('assets/configs/checklogin.php');
check_login();
$aid = $_SESSION['admin_id'];
if (isset($_POST['update_outpatient'])) {
  $p_id = $_GET['p_id'];
  $p_lab_tests = $_POST['p_lab_tests'];
  $p_diagonisis = $_POST['p_diagonisis'];
  $p_lab_results = $_POST['p_lab_results'];
  //$p_type=$_POST['p_type'];
  //$created_at=$_POST['created_at'];
  //$=$_POST['location'];
  //$website=$_POST['website'];
  //$bio=$_POST['bio'];
  //$skill=$_POST['skill'];
  //$dpic=$_FILES["dpic"]["name"];
  //move_uploaded_file($_FILES["dpic"]["tmp_name"],"assets/img/".$_FILES["dpic"]["name"]);
  //$cover=$_FILES["cover"]["name"];
  // move_uploaded_file($_FILES["cover"]["tmp_name"],"assets/img/cover/".$_FILES["cover"]["name"]);

  //sql to inset the values to the database
  $query = "update patients set p_lab_tests=?, p_lab_results=?, p_diagonisis=? where p_id=?";
  $stmt = $mysqli->prepare($query);
  //bind the submitted values with the matching columns in the database.
  $rc = $stmt->bind_param('sssi', $p_lab_tests, $p_lab_results, $p_diagonisis, $p_id);
  $stmt->execute();
  //if binding is successful, then indicate that a new value has been added.
  $msg = "Patient Laboratory Record Updated!";
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
          <div class="col-md-12">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="pages_admin_dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Laboratory</a></li>
                <li class="breadcrumb-item active" aria-current="page">Update Laboratory Patient Tests Record</li>
              </ol>
            </nav>
            <div class="card card-border-color card-border-color-primary">
              <div class="card-header card-header-divider">Laboratory Patient Details<span class="card-subtitle">Please fill required details.</span></div>
              <div class="card-body">
                <?php if (isset($msg)) { ?>
                  <script>
                    setTimeout(function() {
                        swal("Success!", "<?php echo $msg; ?>!", "success");
                      },
                      100);
                  </script>
                  <!--Trigger a pretty success alert-->

                <?php } ?>
                <?php
                $p_id = $_GET['p_id'];
                $ret = "select * from patients where p_id=?";
                $stmt = $mysqli->prepare($ret);
                $stmt->bind_param('i', $p_id);
                $stmt->execute(); //ok
                $res = $stmt->get_result();
                //$cnt=1;
                while ($row = $res->fetch_object()) {
                ?>
                  <form method="POST">
                    <div class="form-group row" style="display:none">
                      <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3">First Name</label>
                      <div class="col-12 col-sm-8 col-lg-6">
                        <input class="form-control" id="inputText3" value="<?php echo $row->p_fname; ?>" name="p_fname" type="text">
                      </div>
                    </div>
                    <div class="form-group row" style="display:none">
                      <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3">Last Name</label>
                      <div class="col-12 col-sm-8 col-lg-6">
                        <input class="form-control" id="inputText3" value="<?php echo $row->p_lname; ?>" name="p_lname" type="text">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3">Diagonisis</label>
                      <div class="col-12 col-sm-8 col-lg-6">
                        <textarea class="form-control" id="editor" name="p_diagonisis" type="text"><?php echo $row->p_diagonisis; ?></textarea>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3">Laboratory Tests</label>
                      <div class="col-12 col-sm-8 col-lg-6">
                        <textarea class="form-control" id="editor1" value="" name="p_lab_tests" type="text"></textarea>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3">Laboratory Results</label>
                      <div class="col-12 col-sm-8 col-lg-6">
                        <textarea class="form-control" id="editor2" value="" name="p_lab_results" type="text"></textarea>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <p class="text-right">
                        <button class="btn btn-space btn-primary" name="update_outpatient" type="submit">Save</button>
                        <button class="btn btn-space btn-secondary">Cancel</button>
                      </p>
                    </div>
              </div>
              </form>
            <?php } ?>
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
  <script src="//cdn.ckeditor.com/4.6.2/basic/ckeditor.js"></script>
  <script type="text/javascript">
    CKEDITOR.replace('editor')
  </script>
  <script type="text/javascript">
    CKEDITOR.replace('editor1')
  </script>
  <script type="text/javascript">
    CKEDITOR.replace('editor2')
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
      //-initialize the javascript
      App.init();
      App.dashboard();

    });
  </script>
</body>

</html>