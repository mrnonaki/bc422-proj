<?php
require 'header.php';
if (isset($_POST['id']) || isset($_GET['id'])) {
	if (isset($_POST['id'])) {
		$id = $_POST['id'];
	} else if (isset($_GET['id'])) {
		$id = $_GET['id'];
	}
	if ($id == 'new') {
		$sql = "SELECT COUNT(*) FROM product";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$id = 'P'.sprintf("%04d", $row["COUNT(*)"] + 1);
		$name = "ชื่อสินค้า";
		$type = '';
		$rate_rent = "ค่าเช่าต่อวัน";
		$rate_ship = "ค่าจัดส่ง";
		$rate_late = "1.5 x ค่าเช่าต่อวัน";
		$rate_damage = "ราคาสินค้า";
		$rate_deposit = "0.5 x ค่าปรับต่อชิ้น";
		$count_all = "จำนวนทั้งหมด";
		$q = 'insert';
	} else {
		$sql = "SELECT * FROM product WHERE id = '$id'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$name = $row["name"];
		$type = $row["type"];
		$rate_rent = $row["rate_rent"];
		$rate_ship = $row["rate_ship"];
		$rate_late = $row["rate_late"];
		$rate_damage = $row["rate_damage"];
		$rate_deposit = $row["rate_deposit"];
		$count_all = $row["count_all"];
		$q = 'update';
	}
}
?>
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa fa-bars"></i> บันทึก / แก้ไข สินค้า <?php echo $id;?></h3>
          </div>
        </div>
        <!-- page start-->
		<form method="post" action="ma_product_3.php">
		<input type="hidden" name="id" value="<?php echo $id;?>">
		<input type="hidden" name="q" value="<?php echo $q;?>">
		  <div class="col-sm-12">
            <div class="form-group">
              <label class="col-sm-2 control-label">ชื่อสินค้า</label>
              <div class="col-sm-10">
                <input type="text" class="form-control input-lg m-bot15" name="name" placeholder="<?php echo $name;?>">
              </div>
              <label class="col-sm-2 control-label">ประเภทสินค้า</label>
              <div class="col-sm-10">
				<select class="form-control input-lg m-bot15" name="type">
				  <option value="">รหัสประเภท</option>
<?php
$sql = "SELECT * FROM type";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
	echo "<option value=\"".$row["id"]."\"";
	if ($row["id"] == $type) {
		echo " selected";
	}
	echo ">".$row["id"].": ".$row["name"]."</option>\n";
}
?>
				</select>
              </div>
              <label class="col-sm-2 control-label">ค่าเช่าต่อวัน</label>
              <div class="col-sm-10">
                <input type="text" class="form-control input-lg m-bot15" name="rate_rent" placeholder="<?php echo $rate_rent;?>">
              </div>
              <label class="col-sm-2 control-label">ค่าจัดส่ง</label>
              <div class="col-sm-10">
                <input type="text" class="form-control input-lg m-bot15" name="rate_ship" placeholder="<?php echo $rate_ship;?>">
              </div>
              <label class="col-sm-2 control-label">ค่าปรับต่อชิ้น</label>
              <div class="col-sm-10">
                <input type="text" class="form-control input-lg m-bot15" name="rate_damage" placeholder="<?php echo $rate_damage;?>">
              </div>
              <label class="col-sm-2 control-label">จำนวนทั้งหมด</label>
              <div class="col-sm-10">
                <input type="text" class="form-control input-lg m-bot15" name="count_all" placeholder="<?php echo $count_all;?>">
              </div>
              <label class="col-sm-2 control-label">ค่าปรับต่อวัน</label>
              <div class="col-sm-10">
                <input type="text" class="form-control input-lg m-bot15" name="rate_late" placeholder="<?php echo $rate_late;?>" disabled>
              </div>
              <label class="col-sm-2 control-label">ค่ามัดจำ</label>
              <div class="col-sm-10">
                <input type="text" class="form-control input-lg m-bot15" name="rate_deposit" placeholder="<?php echo $rate_deposit;?>" disabled>
              </div>
              <label class="col-sm-2 control-label">สรุปจำนวน</label>
              <div class="col-sm-10">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>จำนวนทั้งหมด</th>
                      <th>เสีย - หาย</th>
                      <th>กำลังถูกเช่า</th>
					  <th>พร้อมให้เช่า</th>
                    </tr>
                  </thead>
                  <tbody>
<?php
$sql = "SELECT * FROM product WHERE id='$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
echo "<tr><td>".$row["count_all"]."</td><td>".$row["count_damage"]."</td><td>".$row["count_inrent"]."</td><td>".$row["count_ready"]."</td></tr>\n";
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