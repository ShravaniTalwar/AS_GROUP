<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}

if(!isset($_SESSION['admin']))
{
    header("Location: ../admin/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>AS Group Admin Panel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <style>

        body{
            background:#f4f6f9;
        }

        .sidebar{
            width:250px;
            min-height:100vh;
            background:#198754;
            position:fixed;
            left:0;
            top:0;
        }

        .sidebar a{
            color:white;
            text-decoration:none;
            display:block;
            padding:12px 20px;
        }

        .sidebar a:hover{
            background:rgba(255,255,255,0.15);
        }

        .content{
            margin-left:250px;
        }

        .topbar{
            background:white;
            padding:15px 25px;
            box-shadow:0px 2px 10px rgba(0,0,0,0.1);
        }

        .page-content{
            padding:25px;
        }

    </style>

</head>
<body>