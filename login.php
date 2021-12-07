<?php
  // DB Connection Here
$error_msg = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'db/connect.php';
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $sql = 'select * from login where author_email = "' . $conn->real_escape_string($email) . '"';
    $result = $conn->query($sql);
    if (!$result) {
        die('Error executing query：' . $conn->errno . ' ' . $conn->error);
    } elseif ($result->num_rows == 0) {
        $error_msg = 'Wrong username or password. Please by again.';
    } else {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['author_password'])) {
            $sql = 'select * from author where login_id = ' . $row['author_id'];
            $result = $conn->query($sql);
            $user_info = $result->fetch_assoc();
            $user = [
                'user_login_id' => $row['author_id'],
            ];
            session_start();
            $_SESSION['user'] = $user;
            header('Location:index.php');die;
        } else {
            $error_msg = 'Wrong username or password. Please by again.';
        }
    }
}
?>

<!-- Jamel's Code -->

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Welcome Back | Spyder</title>

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="fonts/font.css">
    <link rel="stylesheet" href="css/main.css">
  </head>
  <body class="full-width auth">
    <section class="auth-panel">
      <div class="auth-header">
        <h1>Sign In</h1>
        <h2>Don't have an account? <a href="register.php">Register</a></h2>
      </div>

      <form 
        action="" 
        method="POST" 
        enctype="multipart/form-data"
      >
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
            Password
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

        <button>Sign In</button>
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