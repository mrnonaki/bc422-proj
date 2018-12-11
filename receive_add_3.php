<?php
$error = 0;
$conn = new mysqli("localhost", "root", "", "proj_rent");
$conn->set_charset("utf8");
if (isset($_POST['id'])) {
	$id = $_POST['id'];
	$sql = "SELECT * FROM rent WHERE agreement='$id'";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()) {
		$total = 0;
		$good_count = 0;
		$bad_count = 0;
		$good = $row["product"]."_G";
		if (isset($_POST[$good])){
			$good_count = $_POST[$good];
			if ($good_count > 0) {
				$total = $total + $good_count;	
				$product = $row["product"];
			}
		}
		$bad = $row["product"]."_B";
		if (isset($_POST[$bad])){
			$bad_count = $_POST[$bad];
			if ($bad_count > 0) {
				$total = $total + $bad_count;
				$product = $row["product"];
			}
		}
		if ($total != $row["count"]) {
			$error = 1;
		}
	}
	if (!$error) {
		$sql = "SELECT COUNT(*) FROM receive";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$receive = 'R'.sprintf("%04d", $row["COUNT(*)"] + 1);
		$date = date("Y-m-d");
		$ps = $_POST['ps'];
		$sql = "INSERT INTO receive VALUES ('$receive', '$date', '$id', '$ps')";
		$result = $conn->query($sql);
		$sql = "SELECT * FROM rent WHERE agreement='$id'";
		$result = $conn->query($sql);
		while($row = $result->fetch_assoc()) {
			$good_count = 0;
			$bad_count = 0;
			$good = $row["product"]."_G";
			if (isset($_POST[$good])){
				$good_count = $_POST[$good];
				if ($good_count > 0) {
					$product = $row["product"];
					$sqll = "UPDATE rent SET receive_good = $good_count WHERE agreement='$id' AND product='$product'";
					$resultt = $conn->query($sqll);
					$sqll = "UPDATE product SET count_inrent = count_inrent - $good_count WHERE id='$product'";
					$resultt = $conn->query($sqll);
				}
			}
			$bad = $row["product"]."_B";
			if (isset($_POST[$bad])){
				$bad_count = $_POST[$bad];
				if ($bad_count > 0) {
					$product = $row["product"];
					$sqll = "UPDATE rent SET receive_bad = $bad_count WHERE agreement='$id' AND product='$product'";
					$resultt = $conn->query($sqll);
					$sqll = "UPDATE product SET count_damage = count_damage + $bad_count WHERE id='$product'";
					$resultt = $conn->query($sqll);
					$sqll = "UPDATE product SET count_inrent = count_inrent - $bad_count WHERE id='$product'";
					$resultt = $conn->query($sqll);
				}
			}
		}
		$sql = "UPDATE agreement SET status = 2 WHERE id='$id'";
		$result = $conn->query($sql);
		require 'stock_update.php';
	} else {
		echo "<strong>Record ERROR !!!<br></strong>";
		echo "<meta http-equiv=\"refresh\" content=\"2;url=receive_add_1.php\">";
	}
}
$conn->close();
header("Location: receive_list_2.php?id=$receive");
?>	