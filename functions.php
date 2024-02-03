<?php
// creatte function 

function value($val)
{
    if (isset($_POST[$val])) {
        echo $_POST[$val];
    }
};

function rowCount($tbl, $col, $val)
{
    global $conn;

    $stm = $conn->prepare("SELECT $col FROM $tbl WHERE $col=?");
    $stm->execute(array($val));
    $res = $stm->rowCount();
    return $res;
}
function DeleteData($tbl, $id)
{
    global $conn;
    $stm = $conn->prepare("DELETE FROM $tbl WHERE  id=?");
    $delete = $stm->execute(array($id));
    return $delete;
}
function UpdateData($tbl,$id){
    global $conn;
    $stm = $conn->prepare("SELECT * FROM $tbl WHERE id=?");
    $stm->execute(array($id));
    $editData = $stm->fetch();
    return $editData;
}

?>