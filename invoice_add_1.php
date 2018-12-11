<?php
$conn = new mysqli("localhost", "root", "", "proj_rent");
$conn->set_charset("utf8");
if (isset($_POST['id'])) {
	$id = $_POST['id'];
	if (isset($_POST['confirm'])) {
		$confirm = $_POST['confirm'];
		if ($confirm == 'confirmed') {
			$sql = "SELECT COUNT(*) FROM invoice";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			$invoice = 'I'.sprintf("%04d", $row["COUNT(*)"] + 1);
			$date = date("Y-m-d");
			$amount = $_POST['amount'];
			$sql = "INSERT INTO invoice VALUES ('$invoice', '$date', '$amount', '$id')";
			$result = $conn->query($sql);
			if ($id[0] == 'O') {
				$sql = "UPDATE agreement SET invoice='$invoice', status= 1 WHERE id='$id'";
				$result = $conn->query($sql);
				$sql = "SELECT * FROM rent WHERE agreement='$id'";
				$result = $conn->query($sql);
				while($row = $result->fetch_assoc()) {
					$product = $row["product"];
					$count = $row["count"];
					$sqll = "UPDATE product SET count_inrent = count_inrent + $count WHERE id='$product'";
					$resultt = $conn->query($sqll);
				}
				require 'stock_update.php';
			} elseif ($id[0] == 'F') {
				$sql = "UPDATE fine SET invoice='$invoice' WHERE id='$id'";
				$result = $conn->query($sql);
				$sql = "SELECT * FROM fine WHERE id='$id'";
				$result = $conn->query($sql);
				$row = $result->fetch_assoc();
				$agreement = $row["agreement"];
				$sql = "UPDATE agreement SET status = 4 WHERE id='$agreement'";
				$result = $conn->query($sql);
			}
		}
	}
	if ($id[0] == 'O') {
		$sql = "SELECT * FROM agreement WHERE id='$id'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$invoice = $row["invoice"];
	} elseif ($id[0] == 'F') {
		$sql = "SELECT * FROM fine WHERE id='$id'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$invoice = $row["invoice"];
	}
}
$conn->close();
header("Location: invoice_list_2.php?id=$invoice");
?>