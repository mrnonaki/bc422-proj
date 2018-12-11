<?php
$conn = new mysqli("localhost", "root", "", "proj_rent");
$conn->set_charset("utf8");
if (isset($_POST['q']) && isset($_POST['id'])) {
	$id = $_POST['id'];
	$name = $_POST['name'];
	$type = $_POST['type'];
	$rate_rent = $_POST['rate_rent'];
	$rate_ship = $_POST['rate_ship'];
	$rate_late = round(($_POST['rate_rent'] * 1.5), -1);
	$rate_damage = $_POST['rate_damage'];
	$rate_deposit = round(($_POST['rate_damage'] * 0.5), -1);
	$count_all = $_POST['count_all'];
	$sql = "SELECT * FROM product WHERE id='$id'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	if ($_POST['q'] == 'insert') {
		if ($id !== '' && $name !== '' && $type !== '' && $rate_rent > 0 && $rate_ship > 0 && $rate_damage > 0 && $rate_deposit > 0 && $count_all > 0) {
			$sql = "INSERT INTO product VALUES ('$id', '$name', '$type', '$rate_rent', '$rate_ship', '$rate_late', '$rate_damage', '$rate_deposit', '$count_all', '0', '0', '$count_all')";
			$result = $conn->query($sql);
			header("Location: ma_product_1.php");
		}
	} elseif ($_POST['q'] == 'update') {
		if ($id !== '') {
			if ($name !== '') {
				$sql = "UPDATE product SET name='$name' WHERE id = '$id'";
				$result = $conn->query($sql);
			}
			if ($type !== '') {
				$sql = "UPDATE product SET type='$type' WHERE id = '$id'";
				$result = $conn->query($sql);
			}
			if ($rate_rent > 0) {
				$sql = "UPDATE product SET rate_rent='$rate_rent' WHERE id = '$id'";
				$result = $conn->query($sql);
			}
			if ($rate_ship > 0) {
				$sql = "UPDATE product SET rate_ship='$rate_ship' WHERE id = '$id'";
				$result = $conn->query($sql);
			}
			if ($rate_late > 0) {
				$sql = "UPDATE product SET rate_late='$rate_late' WHERE id = '$id'";
				$result = $conn->query($sql);
			}
			if ($rate_damage > 0) {
				$sql = "UPDATE product SET rate_damage='$rate_damage' WHERE id = '$id'";
				$result = $conn->query($sql);
			}
			if ($rate_deposit > 0) {
				$sql = "UPDATE product SET rate_deposit='$rate_deposit' WHERE id = '$id'";
				$result = $conn->query($sql);
			}
			if ($count_all >= $row["count_all"]) {
				$sql = "UPDATE product SET count_all='$count_all' WHERE id = '$id'";
				$result = $conn->query($sql);
				require 'stock_update.php';
			}
			header("Location: ma_product_1.php");
		}
	}
	echo "<strong>Record ERROR !!!</strong>";
	echo "<meta http-equiv=\"refresh\" content=\"2;url=ma_product_1.php\">";
}
$conn->close();
?>