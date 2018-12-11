<?php
$conn = new mysqli("localhost", "root", "", "proj_rent");
$conn->set_charset("utf8");
if (isset($_POST['id'])) {
	$id = $_POST['id'];
	$days = $_POST['days'];
	$start = date("Y-m-d");
	$end = date("Y-m-d", strtotime("$start + $days day"));
	$customer = $_POST['customer'];
	$staff = $_POST['staff'];
	$sql = "INSERT INTO agreement VALUES ('$id', '$start', '$end', '$customer', '$staff', NULL, '0')";
	$result = $conn->query($sql);
	
	$sql = "SELECT * FROM product";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()) {
		if (isset($_POST[$row["id"]])) {
			$product = $row["id"];
			$count = $_POST[$row["id"]];
			if ($count > 0) {
				$deposit = $count * $row["rate_deposit"];
				$service = $count * (($row["rate_rent"] * $days) + $row["rate_ship"]);
				$sqll = "INSERT INTO rent VALUES ('', '$id', '$product', '$count', '$deposit', '$service', NULL, NULL)";
				$resultt = $conn->query($sqll);
			}
		}
	}
}
$conn->close();
header("Location: order_list_2.php?id=$id");
?>