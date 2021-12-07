<?php
	session_start();
	require_once "db/connect.php";
	if (isset($_SESSION['user'])) {
	    $user = $_SESSION['user'];
        $login_id = $user['user_login_id'];
        $sql = 'select author.*,login.author_email from author join login on author.login_id = login.author_id where author.login_id = ' . $login_id;
        $result = $conn->query($sql);
        $user_info = $result->fetch_assoc();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">

    <title>Blog</title>
</head>
<body>
<div class="container p20">
    <div class="row flex-a-center flex-wrap">
        <div class="col-xs-9 col-sm-9 col-lg-4 col-md-4 row flex-a-center" >
            <div class="col-xs-5 col-sm-5 col-lg-3 col-md-3">
                <a href="index.php">
                    <img src="assets/img/header.png" width="50" height="50" class="b-radius-50">
                </a>
            </div>
            
            <h3 class="blog-title">Spyder Blogs</h3>
            
        </div>

        <div class="hidden-xs hidden-sm col-lg-4 col-md-4"></div>
        <form class="hidden-xs hidden-sm col-lg-2 col-md-2 search-form">
            <input class="form-control input-sm" type="search" placeholder="Search blogs" name="search"> <i class="glyphicon glyphicon-search search-icon-position do-search"></i>
        </form>
        <?php if (!isset($login_id)) { ?>
        <div class="col-xs-2 col-sm-2 col-lg-2 col-md-2">
            <a href="login.php" class="btn btn-default btn-sm">Login</a>
            <a href="register.php" class="btn btn-default btn-sm">Register</a>
        </div>
        <?php } else { ?>
        <div class="col-xs-3 col-sm-3 col-lg-2 col-md-2">
            <a href="profile.php"><img src="assets/img/header.png" width="30" height="30" class="b-radius-50"></a>
            <a href="includes/logout.php"><span class="ml20 hidden-xs hidden-sm"><?php echo $user_info['author_fname'] . ' ' . $user_info['author_lname']; ?></span></a>
        </div>
        <?php } ?>
    </div>
    <hr>
