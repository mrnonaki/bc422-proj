<?php
require 'header.php';
?>
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa fa-bars"></i> รายการใบปรับ</h3>
          </div>
        </div>
        <!-- page start-->
		<form method="post" action="fine_list_2.php">
          <div class="col-sm-12">
			<select class="form-control input-lg m-bot15" name="id">
                <option>เลือกรายการใบปรับ</option>
<?php
$sql = "SELECT fine.id AS id, customer.name AS name FROM fine JOIN agreement ON fine.agreement = agreement.id JOIN customer ON agreement.customer = customer.id ORDER BY id DESC";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
	echo "<option value=\"".$row["id"]."\">".$row["id"].": ".$row["name"]."</option>\n";
}
?>
            </select>
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