<?php
require 'header.php';
if (isset($_POST['id']) || isset($_GET['id'])) {
	if (isset($_POST['id'])) {
		$id = $_POST['id'];
	} else if (isset($_GET['id'])) {
		$id = $_GET['id'];
	}
	$sql = "SELECT * FROM receive JOIN agreement ON receive.agreement = agreement.id WHERE receive.id='$id'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$date = $row["date"];
	$ps = $row["ps"];
	$agreement = $row["agreement"];
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
            <h3 class="page-header"><i class="fa fa fa-bars"></i> รายการรับคืน <?php echo $id;?></h3>
          </div>
        </div>
        <!-- page start-->
		<form method="post" action="fine_add_2.php">
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
					<td colspan="10"><h3><center>ใบรับคืน</center></h3></td>
                  </tr>
				  <tr>
					<td colspan="10"><center>Next-Hop Co., Ltd.<br>2/491 ซอยรามอินทรา 3<br>แขวงอนุสาวรีย์ เขตบางเขน<br>กรุงเทพ 10220</center></td>
                  </tr>
                  <tr>
				    <td>พนักงาน:</td>
                    <td colspan="7"><?php echo $staff_name;?></td>
                    <td>เลขที่ใบรับคืน:</td>
					<td><?php echo $id;?></td>
                  </tr>
                  <tr>
				    <td>ลูกค้า:</td>
                    <td colspan="7"><?php echo $customer_name." (".$customer_tel.")";?></td>
					<td>เลขที่สัญญา:</td>
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
					<td><b>จำนวน</b></td>
					<td><b>เสีย - หาย</b></td>
					<td><b>ปกติ</b></td>
				  </tr>
<?php
$count_all = 0;
$bad_all = 0;
$good_all = 0;
$sql = "SELECT * FROM rent JOIN product ON rent.product = product.id WHERE agreement='$agreement'";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
	echo "<tr><td colspan=\"7\">".$row["name"]."</td><td>".$row["count"];
	echo "</td><td>".$row["receive_bad"]."</td><td>".$row["receive_good"]."</td></tr>\n";
	$count_all = $count_all + $row["count"];
	$bad_all = $bad_all + $row["receive_bad"];
	$good_all = $good_all + $row["receive_good"];
}
?>
				  <tr>
				    <td><b>ยอดรวม<b></td>
				    <td colspan="6"></td>
					<td><b><?php echo $count_all;?></b></td>
					<td><b><?php echo $bad_all;?></b></td>
					<td><b><?php echo $good_all;?></b></td>
				  </tr>
				  <tr>
				    <td colspan="10">หมายเหตุ: <?php echo $ps;?></td>
				  </tr>
				  <tr>
				  </tr>
                </tbody>
              </table>
            </section>
          </div>
<?php
$sql = "SELECT * from fine WHERE agreement='$agreement'";
$result = $conn->query($sql);
if ($result->num_rows) {
	$confirmed = 'disabled';
} else {
	$confirmed = '';
}
?>
		  <div class="checkbox">
            <label>
              <input type="checkbox" name="confirm" value="confirmed" <?php echo $confirmed;?>>
			  สร้างใบปรับ - คืนมัดจำ
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