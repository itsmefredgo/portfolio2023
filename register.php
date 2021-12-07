<?php
// DB Connection Here
$error_msg = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'db/connect.php';
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $full_name = htmlspecialchars($_POST['fullName']);

    $password = password_hash($password, PASSWORD_BCRYPT);

    $sql = 'insert into login (`author_email`, `author_password`) value ("'.$email.'", "'.$password.'")';

    $result = $conn->query($sql);
    if ($result) {
        $login_id = $conn->insert_id;
        // insert author
        $full_name = explode(' ', $full_name);
        $first_name = $full_name[0];
        $last_name = isset($full_name[1]) ? $full_name[1] : '';
        $sql = 'insert into author (`author_fname`, `author_lname`, `author_phone`, `author_type`, `author_intro`, `login_id`) value ("'.$first_name.'", "'.$last_name.'", "", "", "", '.$login_id.')';
        $res = $conn->query($sql);
        if ($res) {
            // register success
            header('Location:login.php');die;
        } else {
            $error_msg = 'Register fail.';
        }
    } elseif ($conn->errno == 1062) {
        $error_msg = 'The email already exists. Please choose another.';
    } else {
        die('Error executing query：' . $conn->errno . ' ' . $conn->error);
    }
}


?>

<!-- Jamel's Code -->

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Register | Spyder</title>

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="fonts/font.css">
    <link rel="stylesheet" href="css/main.css">
  </head>
  <body class="full-width auth">
    <section class="auth-panel">
      <div class="auth-header">
        <h1>Register</h1>
        <h2>Already have an account? <a href="login.php">Log In</a></h2>
      </div>

      <form 
        action="" 
        method="POST" 
        enctype="multipart/form-data"
      >
        <div class="input-container">
          <label for="fullName">
            Your full name
          </label>
          <input
            name="fullName"
            id="fullName"
            lang="en"
            type="text"
            placeholder="John Doe"
            required
          >
        </div>

        <div class="input-container">
          <label for="email">
            Email address
          </label>
          <input
            name="email"
            id="email"
            lang="en"
            type="email"
            placeholder="john@doe.com"
            required
          >
        </div>

        <div class="input-container">
          <label for="password">
            Create a password
          </label>
          <input
            name="password"
            id="password"
            lang="en"
            type="password"
            placeholder="Enter your password"
            required
          >
        </div>

        <button>Create my account</button>
      </form>
    </section>
    <section class="auth-decoration">
      <div class="auth-decoration-reference">
        <span>Video by <strong>Rostislav Uzunov</strong> from Pexels</span>
      </div>
      <video src="assets/video.mp4" loop autoplay muted></video>
    </section>
  </body>
</html>