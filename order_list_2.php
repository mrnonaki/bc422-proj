<?php
require 'header.php';
if (isset($_POST['id']) || isset($_GET['id'])) {
	if (isset($_POST['id'])) {
		$id = $_POST['id'];
	} else if (isset($_GET['id'])) {
		$id = $_GET['id'];
	}
	$sql = "SELECT * FROM agreement WHERE id = '$id'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$start = $row["date_start"];
	$end = $row["date_end"];
	$staff = $row["staff"];
	$customer = $row["customer"];
	$invoice = $row["invoice"];
	$sql = "SELECT * FROM staff WHERE id = '$staff'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$staff_name = $row["name"];
	$sql = "SELECT * FROM customer WHERE id = '$customer'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$customer_name = $row["name"];
	$customer_tel = $row["tel"];
	$customer_address = $row["address"];
}
?>
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa fa-bars"></i> รายการเช่า <?php echo $id;?></h3>
          </div>
        </div>
        <!-- page start-->
		<form method="post" action="invoice_add_1.php">
		<input type="hidden" name="id" value="<?php echo $id;?>">
          <div id="printableArea" class="col-sm-12">
            <section class="panel">
              <table class="table">
                <tbody>
                  <tr>
					<td style="width: 10%"></td>
					<td style="width: 10%"></td>
					<td style="width: 10%"></td>
					<td style="width: 10%"></td>
					<td style="width: 10%"></td>
					<td style="width: 10%"></td>
					<td style="width: 10%"></td>
					<td style="width: 10%"></td>
					<td style="width: 10%"></td>
					<td style="width: 10%"></td>
                  </tr>
                  <tr>
					<td colspan="10"><h3><center>สัญญาเช่า</center></h3></td>
                  </tr>
				  <tr>
					<td colspan="10"><center>Next-Hop Co., Ltd.<br>2/491 ซอยรามอินทรา 3<br>แขวงอนุสาวรีย์ เขตบางเขน<br>กรุงเทพ 10220</center></td>
                  </tr>
                  <tr>
				    <td>พนักงาน:</td>
                    <td colspan="7"><?php echo $staff_name;?></td>
                    <td>เลขที่สัญญา:</td>
					<td><?php echo $id;?></td>
                  </tr>
                  <tr>
				    <td>ลูกค้า:</td>
                    <td colspan="7"><?php echo $customer_name." (".$customer_tel.")";?></td>
					<td>สัญญาเริ่มต้น:</td>
					<td><?php echo $start;?></td>
                  </tr>
                  <tr>
                    <td>ที่อยู่:</td>
					<td colspan="7"><?php echo $customer_address;?></td>
                    <td>สัญญาสิ้นสุด:</td>
					<td><?php echo $end;?></td>
                  </tr>
				  <tr>
				    <td colspan="6"><b>รายการ</b></td>
					<td><b>จำนวน</b></td>
					<td><b>ค่ามัดจำ</b></td>
					<td><b>ค่าบริการ</b></td>
					<td><b>รวม</b></td>
				  </tr>
<?php
$error = 0;
$count_all = 0;
$deposit_all = 0;
$service_all = 0;
$total_all = 0;
$sql = "SELECT * FROM rent JOIN product ON rent.product = product.id WHERE agreement='$id'";
$result = $conn->query($sql);
$product_total = 0;
while($row = $result->fetch_assoc()) {
	$product_total = $row["deposit"] + $row["service"];
	echo "<tr><td colspan=\"6\">".$row["name"]."</td><td>".$row["count"];
	if ($row["count"] > $row["count_ready"]) {
		$error = 1;
		echo " (".$row["count_ready"].")";
	}
	echo "</td><td>".$row["deposit"]."</td><td>".$row["service"]."</td><td>".$product_total."</td></tr>\n";
	$count_all = $count_all + $row["count"];
	$deposit_all = $deposit_all + $row["deposit"];
	$service_all = $service_all + $row["service"];
	$total_all = $total_all + $product_total;
}
?>
				  <tr>
				    <td><b>ยอดรวม<b></td>
				    <td colspan="5"></td>
					<td><b><?php echo $count_all;?></b></td>
					<td><b><?php echo $deposit_all;?></b></td>
					<td><b><?php echo $service_all;?></b></td>
					<td></td>
				  </tr>
				  <tr>
				    <td colspan="8"></td>
					<td><b>ยอดชำระ</b></td>
					<td><b><?php echo $total_all;?></b></td>
				  </tr>
				  <tr>
				  </tr>
                </tbody>
              </table>
			  <input type="hidden" name="amount" value="<?php echo $total_all;?>">
            </section>
          </div>
<?php
if ($invoice == NULL) {
	if ($error) {
		echo "<label class=\"col-sm-2 control-label\">หมายเหตุ: สินค้ามีไม่เพียงพอให้เช่า</label><br>";
		$confirmed = 'disabled';
	} else {
		$confirmed = '';
	}
} else {
	$confirmed = 'disabled';
}
?>
		  <div class="checkbox">
            <label>
              <input type="checkbox" name="confirm" value="confirmed" <?php echo $confirmed;?>>
			  สร้างใบเสร็จ
            </label>
          </div>
		  <button type="submit" class="btn btn-primary">ยืนยัน</button>
		  <button type="button" class="btn btn-primary" onclick="printDiv('printableArea')">Print</button>
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