<?php
  require_once "includes/header.php";
  include("includes/functions.php");

?>

<main>
  <section class="profile">
    <h2 class="sectionHeader">My Profile</h2>

    <div class="userDetails">
      <img class="profileAvatar" src="https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/great-ocean-road-174028267-1494616481.jpg" alt="User Avatar">

      <div class="userInfoWrapper">
        <div class="userInfoTop">
          <span class="userName">Allen Walker</span>
          <?php
          /*
            if ($_SESSION['name'] === $_GET['profileId']) {
              echo "
                <button class='mainBtn'>Edit Profile</button>
              ";
            } else {
              echo "
                <button class='mainBtn'>Follow</button>
              ";
            }
          */

          ?>
         
          <a class="editProfileLink" href="editProfile.php">Edit Profile</a>
          

        </div>

        <div class="userInfo">
          <span>Phone: 902-222-3333</span>
          <span>Email: allenwalker@gmail.com</span>
          <span>I am a cool dude and I write amazing blogs!</span>
        </div>
      </div>
    </div>
  </section>

  <section class="recentBlogs">
    <h2 class="sectionHeader">Recent Blogs</h2>
  </section>
</main>

<?php
  require_once "includes/footer.php";
?>