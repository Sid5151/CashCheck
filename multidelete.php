<?php
include "dbconnect1.php";
$all_id = $_POST['allid'];
$str = implode(",", $all_id);
$mdeletequery = "Delete from addexp where ID in ({$str})";
$mdqconnect = mysqli_query($conn, $mdeletequery);
if ($mdqconnect) {
    echo 1;
} else {
    echo 0;
}
