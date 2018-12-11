<?php
require 'header.php';
if (isset($_POST['id']) || isset($_GET['id'])) {
	if (isset($_POST['id'])) {
		$id = $_POST['id'];
	} else if (isset($_GET['id'])) {
		$id = $_GET['id'];
	}
	$sql = "SELECT * FROM fine JOIN agreement ON fine.agreement = agreement.id WHERE fine.id='$id'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$date = $row["date"];
	$agreement = $row["agreement"];
	$late = $row["late"];
	$damage = $row["damage"];
	$staff = $row["staff"];
	$customer = $row["customer"];
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
            <h3 class="page-header"><i class="fa fa fa-bars"></i> รายการปรับ <?php echo $id;?></h3>
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
					<td colspan="10"><h3><center>ใบปรับ</center></h3></td>
                  </tr>
				  <tr>
					<td colspan="10"><center>Next-Hop Co., Ltd.<br>2/491 ซอยรามอินทรา 3<br>แขวงอนุสาวรีย์ เขตบางเขน<br>กรุงเทพ 10220</center></td>
                  </tr>
                  <tr>
				    <td>พนักงาน:</td>
                    <td colspan="7"><?php echo $staff_name;?></td>
                    <td>เลขที่ใบปรับ:</td>
					<td><?php echo $id;?></td>
                  </tr>
                  <tr>
				    <td>ลูกค้า:</td>
                    <td colspan="7"><?php echo $customer_name." (".$customer_tel.")";?></td>
					<td>เลขที่ใบรับคืน:</td>
					<td><?php echo $agreement;?></td>
                  </tr>
                  <tr>
                    <td>ที่อยู่:</td>
					<td colspan="7"><?php echo $customer_address;?></td>
                    <td>วันที่:</td>
					<td><?php echo $date;?></td>
                  </tr>
				  <tr>
				    <td colspan="7"><b>รายการ</b></td>
					<td><b>สถานะ</b></td>
					<td><b>จำนวน</b></td>
					<td><b>ค่าปรับ</b></td>
				  </tr>
<?php
$fine_total = 0;
$sql = "SELECT * FROM receive WHERE agreement='$agreement'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$receive_date = $row["date"];
$sql = "SELECT * FROM agreement WHERE id='$agreement'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$end_date = $row["date_end"];
if (strtotime($receive_date) > strtotime($end_date)) {
	$late_day = (strtotime($receive_date) - strtotime($end_date)) / 86400;
} else {
	$late_day = 0;
}
$deposit = 0;
$late_fine = 0;
$sql = "SELECT * FROM rent JOIN product ON rent.product = product.id WHERE agreement='$agreement'";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
	$deposit = $deposit + $row["deposit"];
	if ($late_day) {
		$late_fine = $late_fine + ($row["rate_late"] * $row["count"] * $late_day);
	}
	if ($row["receive_bad"]) {
		$fine = $row["rate_damage"] * $row["receive_bad"];
		$fine_total = $fine_total + $fine;
		echo "<tr><td colspan=\"7\">".$row["name"]."</td><td>เสีย - หาย</td><td>".$row["count"]."</td><td>".$fine."</td></tr>\n";
	}
}
if ($late_day) {
	$fine_total = $fine_total + $late_fine;
	echo "<tr><td colspan=\"7\">กำหนดส่งคืน ".$end_date." - วันที่ส่งคืน ".$receive_date."</td><td>เกินกำหนด</td><td></td><td>".$late_fine."</td></tr>\n";
}
?>
				  <tr>
				    <td colspan="8"></td>
					<td><b>ยอดรวม<b></td>
					<td><b><?php echo $fine_total;?></b></td>
				  </tr>
				  <tr>
				    <td colspan="8"></td>
					<td><b>ยอดมัดจำ<b></td>
					<td><b><?php echo $deposit;?></b></td>
				  </tr>
<?php
if ($fine_total >= $deposit) {
	$over_deposit = 1;
	$net_txt = "ยอดที่ต้องชำระ";
	$net_value = $fine_total - $deposit;
} else {
	$over_deposit = 0;
	$net_txt = "คืนมัดจำ";
	$net_value = $deposit - $fine_total;
}
?>
				  <tr>
				    <td colspan="8"></td>
					<td><b><?php echo $net_txt;?><b></td>
					<td><b><?php echo $net_value;?></b></td>
				  </tr>
				  <tr>
				  </tr>
                </tbody>
              </table>
			  <input type="hidden" name="amount" value="<?php echo $net_value;?>">
            </section>
          </div>
<?php
$sql = "SELECT * FROM fine WHERE id='$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$invoice = $row["invoice"];

if (!$over_deposit){
	$confirmed = 'disabled';
	$disable = 'disabled';
} elseif ($invoice) {
	$confirmed = 'disabled';
	$disable = '';
} else {
	$confirmed = '';
	$disable = '';
}
?>
		  <div class="checkbox">
            <label>
              <input type="checkbox" name="confirm" value="confirmed" <?php echo $confirmed;?>>
			  สร้างใบเสร็จ
            </label>
          </div>
		  <button type="submit" class="btn btn-primary" <?php echo $disable;?>>ยืนยัน</button>
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