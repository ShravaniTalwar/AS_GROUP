<?php

include("../../includes/db.php");

$id = $_GET['id'];

$query = "DELETE FROM purchases WHERE id='$id'";

if(mysqli_query($conn,$query))
{
    header("Location:view.php");
    exit();
}
else
{
    echo "Error : ".mysqli_error($conn);
}

?>