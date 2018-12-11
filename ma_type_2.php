<?php
require 'header.php';
if (isset($_POST['id']) || isset($_GET['id'])) {
	if (isset($_POST['id'])) {
		$id = $_POST['id'];
	} else if (isset($_GET['id'])) {
		$id = $_GET['id'];
	}
	if ($id == 'new') {
		$sql = "SELECT COUNT(*) FROM type";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$id = 'T'.sprintf("%04d", $row["COUNT(*)"] + 1);
		$name = "ชื่อประเภท";
		$q = 'insert';
	} else {
		$sql = "SELECT * FROM type WHERE id = '$id'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$id = $row["id"];
		$name = $row["name"];
		$q = 'update';
	}
}
?>
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa fa-bars"></i> บันทึก / แก้ไข ประเภท <?php echo $id;?></h3>
          </div>
        </div>
        <!-- page start-->
		<form method="post" action="ma_type_3.php">
		<input type="hidden" name="id" value="<?php echo $id;?>">
		<input type="hidden" name="q" value="<?php echo $q;?>">
		  <div class="col-sm-12">
            <div class="form-group">
              <label class="col-sm-2 control-label">ชื่อประเภท</label>
              <div class="col-sm-10">
                <input type="text" class="form-control input-lg m-bot15" name="name" placeholder="<?php echo $name;?>">
              </div>
              <label class="col-sm-2 control-label">รายการสินค้า</label>
              <div class="col-sm-10">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>รหัสสินค้า</th>
                      <th>ชื่อสินค้า</th>
                      <th>จำนวนทั้งหมด</th>
                    </tr>
                  </thead>
                  <tbody>
<?php
$sql = "SELECT * FROM product WHERE type='$id' ORDER BY id";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
	echo "<tr><td><a href=\"ma_product_2.php?id=".$row["id"]."\" target=\"_blank\">".$row["id"]."</a></td><td>".$row["name"]."</td><td>".$row["count_all"]."</td></tr>\n";
}
?>
                  </tbody>
                </table>
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