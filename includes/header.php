<?php
	session_start();
	require_once "db/connect.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Spider Blogs</title>
	<link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/main.css">
</head>
<body>
  <section class="navbarWrapper">
      <header>
        <img class="logo" src="https://livejones.com/wp-content/uploads/2020/05/logo-Placeholder.png" alt="Brand logo">
      </header>

      <section class="rightWrapper">
        <div class="searchbar">
          <div class="searchIcon">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
          </div>
        
          <input class="searchInput" type="text" placeholder="Search Blogs">
        </div>

        <?php
          if (isset($_SESSION['name'])) {
            echo "
              <div class='userWrapper'>
                <img class='userAvatar' src='https://st4.depositphotos.com/4329009/19956/v/380/depositphotos_199564354-stock-illustration-creative-vector-illustration-default-avatar.jpg' alt='User Avatar'>
                <span>Allen Walker</span>
              </div>
            ";
          } else {
            echo "
              <div class='buttonsWrapper'>
                <button class='ghostBtn'>Login</button>
                <button class='mainBtn'>Register</button>
              </div>
            ";
          }
        ?>

      
      </section>

      
    
  </section>
