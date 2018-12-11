<?php
$conn = new mysqli("localhost", "root", "", "proj_rent");
$conn->set_charset("utf8");
if (isset($_POST['q']) && isset($_POST['id'])) {
	$id = $_POST['id'];
	$name = $_POST['name'];
	$tel = $_POST['tel'];
	$address = $_POST['address'];
	if ($_POST['q'] == 'insert') {
		if ($id !== '' && $name !== '' && $tel !== '' && $address !== '') {
			$sql = "INSERT INTO customer VALUES ('$id', '$name', '$tel', '$address')";
			$result = $conn->query($sql);
			header("Location: ma_customer_1.php");
		}
	} elseif ($_POST['q'] == 'update') {
		if ($id !== '') {
			if ($name !== '') {
				$sql = "UPDATE customer SET name='$name' WHERE id = '$id'";
				$result = $conn->query($sql);
			}
			if ($tel !== '') {
				$sql = "UPDATE customer SET tel='$tel' WHERE id = '$id'";
				$result = $conn->query($sql);
			}
			if ($address !== '') {
				$sql = "UPDATE customer SET address='$address' WHERE id = '$id'";
				$result = $conn->query($sql);
			}
			header("Location: ma_customer_1.php");
		}
	}
	echo "<strong>Record ERROR !!!</strong>";
	echo "<meta http-equiv=\"refresh\" content=\"2;url=ma_customer_1.php\">";
}
$conn->close();
?>