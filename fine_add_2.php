<?php
$conn = new mysqli("localhost", "root", "", "proj_rent");
$conn->set_charset("utf8");
if (isset($_POST['id'])) {
	$id = $_POST['id'];
	if (isset($_POST['confirm'])) {
		$confirm = $_POST['confirm'];
		if ($confirm == 'confirmed') {
			$sql = "SELECT * FROM receive WHERE id='$id'";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			$receive_date = $row["date"];
			$agreement = $row["agreement"];
			$sql = "SELECT * FROM agreement WHERE id='$agreement'";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			if (strtotime($receive_date) > strtotime($row["date_end"])) {
				$late_day = (strtotime($receive_date) - strtotime($row["date_end"])) / 86400;
			} else {
				$late_day = 0;
			}
			if ($late_day) {
				$late_fine = 0;
				$sql = "SELECT * FROM rent JOIN product ON rent.product = product.id WHERE agreement='$agreement'";
				$result = $conn->query($sql);
				while($row = $result->fetch_assoc()) {
					$late_fine = $late_fine + ($row["rate_late"] * $row["count"] *$late_day);
				}
			}
			$damage_fine = 0;
			$sql = "SELECT * FROM rent JOIN product ON rent.product = product.id WHERE agreement='$agreement'";
			$result = $conn->query($sql);
			while($row = $result->fetch_assoc()) {
				$damage_fine = $damage_fine + ($row["rate_damage"] * $row["receive_bad"]);
			}
			$sql = "SELECT COUNT(*) FROM fine";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			$fine = 'F'.sprintf("%04d", $row["COUNT(*)"] + 1);
			$date = date("Y-m-d");			
			$sql = "INSERT INTO fine VALUES ('$fine', '$date', '$agreement', '$late_fine', '$damage_fine', NULL)";
			$result = $conn->query($sql);
			$sql = "UPDATE agreement SET status = 3 WHERE id='$agreement'";
			$result = $conn->query($sql);
		}
	}
	$sql = "SELECT * FROM fine WHERE id='$id'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$invoice = $row["fine"];
}
$conn->close();
header("Location: fine_list_2.php?id=$fine");
?>