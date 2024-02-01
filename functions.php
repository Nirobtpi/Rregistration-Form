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


?>