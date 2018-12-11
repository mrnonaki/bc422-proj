<?php
require 'header.php';
?>
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa fa-bars"></i> บันทึกการเช่า</h3>
          </div>
        </div>
        <!-- page start-->
		<form method="post" action="order_add_2.php">
          <div class="col-sm-12">
            <section class="panel">
              <table class="table table-striped">
                <thead>
				  <tr>
				    <th></th>
					<th></th>
					<th></th>
				    <th>ระยะเวลา</th>
					<th><input class="form-control input-sm" type="text" name="days" placeholder="ระยะเวลาเช่า (วัน)"></th>
				  </tr>
                  <tr>
                    <th>ชื่อสินค้า</th>
                    <th>ค่ามัดจำ</th>
                    <th>ค่าเช่า</th>
					<th>ค่าส่ง</th>
                    <th>จำนวน</th>
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
		echo "<tr><td>".$roww["name"]."</td><td>".$roww["rate_deposit"]."</td><td>".$roww["rate_rent"]."</td><td>".$roww["rate_ship"]."</td>";
		echo "<td><input class=\"form-control input-sm m-bot15\" type=\"text\" name=\"".$roww["id"]."\" placeholder=\"".$roww["count_ready"]."\"></td></tr>\n";
	}
}
?>
                </tbody>
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