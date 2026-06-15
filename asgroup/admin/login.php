<?php
session_start();
include("../includes/db.php");
$conn = mysqli_connect($host,$user,$pass,$dbname);
if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM admins 
              WHERE username='$username' 
              AND password='$password'";

    $result = mysqli_query($conn,$query);

    if(mysqli_num_rows($result) > 0)
    {
        $_SESSION['admin'] = $username;
        header("Location: dashboard.php");
        exit();
    }
    else
    {
        $error = "Invalid Username or Password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>AS Group Admin Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f4f6f9;
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .login-card{
            width:400px;
            border:none;
            border-radius:15px;
            box-shadow:0px 5px 20px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<div class="card login-card p-4">

    <h2 class="text-center mb-4">
        AS Group Login
    </h2>

    <?php
    if(isset($error))
    {
        echo "<div class='alert alert-danger'>$error</div>";
    }
    ?>

    <form method="POST">

        <div class="mb-3">
            <label>Username</label>
            <input type="text"
                   name="username"
                   class="form-control"
                   required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password"
                   name="password"
                   class="form-control"
                   required>
        </div>

        <button class="btn btn-success w-100"
                name="login">
            Login
        </button>

    </form>

</div>

</body>
</html>