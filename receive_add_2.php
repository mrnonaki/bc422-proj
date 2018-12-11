<?php
require 'header.php';
$disable = '';
if (isset($_POST['id']) || isset($_GET['id'])) {
	if (isset($_POST['id'])) {
		$id = $_POST['id'];
	} else if (isset($_GET['id'])) {
		$id = $_GET['id'];
	}
}
?>
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa fa-bars"></i> รับคืน <?php echo $id;?></h3>
          </div>
        </div>
        <!-- page start-->
		<form method="post" action="receive_add_3.php">
		  <input type="hidden" name="id" value="<?php echo $id;?>">
          <div class="col-sm-12">
            <section class="panel">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>ชื่อสินค้า</th>
                    <th>จำนวน</th>
					<th>ปกติ</th>
                    <th>เสีย - หาย</th>
                  </tr>
                </thead>
                <tbody>
<?php
$sql = "SELECT * FROM type";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
	echo "<tr><td colspan=\"5\"><b>".$row["name"]."</b></td></tr>\n";
	$type = $row["id"];
	$sqll = "SELECT * FROM product WHERE type='$type' ORDER BY rate_rent";
	$resultt = $conn->query($sqll);
	while($roww = $resultt->fetch_assoc()) {
		$product = $roww["id"];
		$sqlll = "SELECT * FROM rent JOIN product ON rent.product = product.id WHERE product='$product' AND agreement='$id'";
		$resulttt = $conn->query($sqlll);
		while($rowww = $resulttt->fetch_assoc()) {
			if (!$rowww["receive_good"]) {
				$good = 'สินค้ารับคืนสภาพปกติ';
			} else {
				$good = $rowww["receive_good"];
				$disable = 'disabled';
			}
			if (!$rowww["receive_bad"]) {
				$bad = 'สินค้ารับคืนสภาพเสีย - หาย';
			} else {
				$bad = $rowww["receive_bad"];
				$disable = 'disabled';
			}
			echo "<tr><td>".$rowww["name"]."</td><td>".$rowww["count"]."</td>\n";
			echo "<td><input class=\"form-control input-sm m-bot15\" type=\"text\" name=\"".$roww["id"]."_G\" placeholder=\"".$good."\" ".$disable."></td>\n";
			echo "<td><input class=\"form-control input-sm m-bot15\" type=\"text\" name=\"".$roww["id"]."_B\" placeholder=\"".$bad."\" ".$disable."></td></tr>\n";
		}
	}
}
?>
                <tr><td colspan="4"><input type="text" class="form-control input-sm m-bot15" name="ps" placeholder="หมายเหตุ" <?php echo $disable;?>></td></tr>
				</tbody>
              </table>
            </section>
			<button type="submit" class="btn btn-primary" <?php echo $disable;?>>ยืนยัน</button>
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