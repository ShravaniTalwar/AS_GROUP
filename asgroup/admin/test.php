<?php
include("../includes/db.php");

$result = mysqli_query($conn, "SELECT * FROM admins");

while($row = mysqli_fetch_assoc($result))
{
    echo "ID: ".$row['id']."<br>";
    echo "Username: ".$row['username']."<br>";
    echo "Password: ".$row['password']."<br><hr>";
}
?>