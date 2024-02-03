<?php
require_once('config.php');
$id = $_REQUEST['id'];

// $stm = $conn->prepare("DELETE FROM user  WHERE id=?");
// $stm->execute(array($id));
DeleteData('user',$id);

header("location:index.php?success=Data Delete Successfully");
