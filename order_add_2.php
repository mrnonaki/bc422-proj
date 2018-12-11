<?php
require 'header.php';
if (isset($_POST['days']) && $_POST['days'] > 0) {
	$days = $_POST['days'];
} else {
	echo "<meta http-equiv=\"refresh\" content=\"1;url=order_add_1.php\">";
}
$sql = "SELECT COUNT(*) FROM agreement";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$id = 'O'.sprintf("%04d", $row["COUNT(*)"] + 1);
?>
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa fa-bars"></i> บันทึกการเช่า <?php echo $id;?></h3>
          </div>
        </div>
        <!-- page start-->
		<form method="post" action="order_add_3.php">
		<input type="hidden" name="id" value="<?php echo $id;?>">
		<input type="hidden" name="days" value="<?php echo $days;?>">
		  <div class="col-sm-12">
			<select class="form-control input-lg m-bot15" name="staff">
                <option>เลือกพนักงานขาย</option>
<?php
$sql = "SELECT * FROM staff";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
	echo "<option value=\"".$row["id"]."\">".$row["id"].": ".$row["name"]."</option>\n";
}
?>
            </select>
			<select class="form-control input-lg m-bot15" name="customer">
                <option>เลือกลูกค้า</option>
<?php
$sql = "SELECT * FROM customer";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
	echo "<option value=\"".$row["id"]."\">".$row["id"].": ".$row["name"]."</option>\n";
}
?>
            </select>
            <section class="panel">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>ชื่อสินค้า</th>
                    <th>จำนวน</th>
                    <th>ค่ามัดจำ</th>
					<th>ค่าบริการ</th>
					<th>รวม</th>
                  </tr>
                </thead>
                <tbody>
<?php
$sql = "SELECT * FROM product";
$result = $conn->query($sql);
$total_count = 0;
$total_deposit = 0;
$total_service = 0;
$net = 0;
while($row = $result->fetch_assoc()) {
	if (isset($_POST[$row["id"]])) {
		$count = $_POST[$row["id"]];
		if ($count > 0 && $count <= $row["count_ready"]) {
			$deposit = $count * $row["rate_deposit"];
			$service = $count * (($row["rate_rent"] * $days) + $row["rate_ship"]);
			$total = $deposit + $service;
			echo "<tr><td>".$row["name"]."</td><td>".$count."</td><td>".$deposit."</td><td>".$service."</td><td>".$total."</td></tr>\n";
			echo "<input type=\"hidden\" name=\"".$row["id"]."\" value=\"".$count."\">\n";
			$total_count = $total_count + $count;
			$total_deposit = $total_deposit + $deposit;
			$total_service = $total_service + $service;
			$net = $net + $total;
		}
	}
}
?>
                </tbody>
                <thead>
                  <tr>
                    <th>รวม</th>
<?php
echo "<th>".$total_count."</th>\n";
echo "<th>".$total_deposit."</th>\n";
echo "<th>".$total_service."</th>\n";
echo "<th>".$net."</th>\n";
?>
                  </tr>
                </thead>
              </table>
            </section>
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