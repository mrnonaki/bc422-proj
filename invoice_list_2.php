<?php
require 'header.php';
if (isset($_POST['id']) || isset($_GET['id'])) {
	if (isset($_POST['id'])) {
		$id = $_POST['id'];
	} else if (isset($_GET['id'])) {
		$id = $_GET['id'];
	}
	$sql = "SELECT * FROM invoice WHERE id = '$id'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$date = $row["date"];
	$amount = $row["amount"];
	$ref = $row["ref"];
	if ($ref[0] == 'O') {
		$sql = "SELECT agreement.id AS id, customer.name AS customer, customer.tel AS tel, customer.address AS address, staff.name AS staff FROM agreement JOIN customer ON agreement.customer = customer.id JOIN staff ON agreement.staff = staff.id WHERE invoice='$id'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$customer_name = $row["customer"];
		$customer_tel = $row["tel"];
		$customer_address = $row["address"];
		$staff_name = $row["staff"];
		$agreement = $row["id"];
		$sql = "SELECT SUM(count), SUM(deposit), SUM(service) FROM rent WHERE agreement='$agreement'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$count = $row["SUM(count)"];
		$deposit = $row["SUM(deposit)"];
		$service = $row["SUM(service)"];
		$detail = "1";
	} elseif ($ref[0] == 'F') {
		$sql = "SELECT fine.id AS id, customer.name AS customer, customer.tel AS tel, customer.address AS address, staff.name AS staff FROM fine JOIN agreement ON fine.agreement = agreement.id JOIN customer ON agreement.customer = customer.id JOIN staff ON agreement.staff = staff.id WHERE fine.invoice='$id'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$customer_name = $row["customer"];
		$customer_tel = $row["tel"];
		$customer_address = $row["address"];
		$staff_name = $row["staff"];
		$detail = "2";
	}
}
?>
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa fa-bars"></i> ใบเสร็จรับเงิน <?php echo $id;?></h3>
          </div>
        </div>
        <!-- page start-->
		<form method="post">
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
					<td colspan="10"><h3><center>ใบเสร็จรับเงิน</center></h3></td>
                  </tr>
				  <tr>
					<td colspan="10"><center>Next-Hop Co., Ltd.<br>2/491 ซอยรามอินทรา 3<br>แขวงอนุสาวรีย์ เขตบางเขน<br>กรุงเทพ 10220</center></td>
                  </tr>
                  <tr>
				    <td>พนักงาน:</td>
                    <td colspan="7"><?php echo $staff_name;?></td>
                    <td>เลขที่ใบเสร็จ:</td>
					<td><?php echo $id;?></td>
                  </tr>
                  <tr>
				    <td>ลูกค้า:</td>
                    <td colspan="7"><?php echo $customer_name." (".$customer_tel.")";?></td>
					<td>เลขที่อ้างอิง:</td>
					<td><?php echo $ref;?></td>
                  </tr>
                  <tr>
                    <td>ที่อยู่:</td>
					<td colspan="7"><?php echo $customer_address;?></td>
                    <td>วันที่ชำระ:</td>
					<td><?php echo $date;?></td>
                  </tr>
				  <tr>
				    <td colspan="6"><b>รายการ</b></td>
					<td></td>
					<td><b>จำนวน</b></td>
					<td></td>
					<td><b>รวม</b></td>
				  </tr>
<?php
if ($detail == 1) {
	echo "<tr><td colspan=\"6\">ค่าบริการ - เช่ายืมอุปกรณ์คอมพิวเตอร์</td><td></td><td>".$count."</td><td></td><td>".$service."</td></tr>";
	echo "<tr><td colspan=\"6\">ค่ามัดจำ - เช่ายืมอุปกรณ์คอมพิวเตอร์</td><td></td><td></td><td></td><td>".$deposit."</td></tr>";
} elseif ($detail == 2) {
	echo "<tr><td colspan=\"6\">ค่าปรับ - เช่ายืมอุปกรณ์คอมพิวเตอร์</td><td></td><td>1</td><td></td><td>".$amount."</td></tr>";
}
?>
				  <tr>
				    <td colspan="8"></td>
					<td><b>ยอดชำระ</b></td>
					<td><b><?php echo $amount;?></b></td>
				  </tr>
				  <tr>
				  </tr>
                </tbody>
              </table>
            </section>
          </div>
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