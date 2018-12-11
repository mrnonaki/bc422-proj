<?php
require 'header.php';
if (isset($_POST['id']) || isset($_GET['id'])) {
	if (isset($_POST['id'])) {
		$id = $_POST['id'];
	} else if (isset($_GET['id'])) {
		$id = $_GET['id'];
	}
	if ($id == 'new') {
		$sql = "SELECT COUNT(*) FROM customer";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$id = 'C'.sprintf("%04d", $row["COUNT(*)"] + 1);
		$name = "ชื่อลูกค้า";
		$tel = "เบอร์โทรลูกค้า";
		$address = "ที่อยู่ลูกค้า";
		$q = 'insert';
	} else {
		$sql = "SELECT * FROM customer WHERE id = '$id'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$name = $row["name"];
		$tel = $row["tel"];
		$address = $row["address"];
		$q = 'update';
	}
}
?>
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa fa-bars"></i> บันทึก / แก้ไข ลูกค้า <?php echo $id;?></h3>
          </div>
        </div>
        <!-- page start-->
		<form method="post" action="ma_customer_3.php">
		<input type="hidden" name="id" value="<?php echo $id;?>">
		<input type="hidden" name="q" value="<?php echo $q;?>">
		  <div class="col-sm-12">
            <div class="form-group">
              <label class="col-sm-2 control-label">ชื่อลูกค้า</label>
              <div class="col-sm-10">
                <input type="text" class="form-control input-lg m-bot15" name="name" placeholder="<?php echo $name;?>">
              </div>
              <label class="col-sm-2 control-label">เบอร์โทรลูกค้า</label>
              <div class="col-sm-10">
                <input type="text" class="form-control input-lg m-bot15" name="tel" placeholder="<?php echo $tel;?>">
              </div>
              <label class="col-sm-2 control-label">ที่อยู่ลูกค้า</label>
              <div class="col-sm-10">
                <input type="text" class="form-control input-lg m-bot15" name="address" placeholder="<?php echo $address;?>">
              </div>
			</div>
			<button type="submit" class="btn btn-primary">ยืนยัน</button>
          </div>
		</form>
        <!-- page end-->
      </section>
    </section>
    <!--main content end-->

  </section>
  <!-- container section end -->
<?php
require 'footer.php';
?>