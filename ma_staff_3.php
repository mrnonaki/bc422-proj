<?php
$conn = new mysqli("localhost", "root", "", "proj_rent");
$conn->set_charset("utf8");
if (isset($_POST['q']) && isset($_POST['id']) && isset($_POST['name'])) {
	$id = $_POST['id'];
	$name = $_POST['name'];
	if ($_POST['q'] == 'insert') {
		if ($id !== '' && $name !== '') {
			$sql = "INSERT INTO staff VALUES ('$id', '$name')";
			$result = $conn->query($sql);
			header("Location: ma_staff_1.php");
		}
	} elseif ($_POST['q'] == 'update') {
		if ($id !== '' && $name !== '') {
			$sql = "UPDATE staff SET name='$name' WHERE id = '$id'";
			$result = $conn->query($sql);
			header("Location: ma_staff_1.php");
		}
	}
	echo "<strong>Record ERROR !!!</strong>";
	echo "<meta http-equiv=\"refresh\" content=\"2;url=ma_staff_1.php\">";
}
$conn->close();
?>