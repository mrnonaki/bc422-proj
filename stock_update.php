<?php
$sql = "UPDATE product SET count_ready = count_all - (count_damage + count_inrent)";
$result = $conn->query($sql);
?>