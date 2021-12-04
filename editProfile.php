<?php
  require_once "includes/header.php";
  include("includes/functions.php");
?>

<main>
  <section class="editProfile">
    <h2 class="sectionHeader">Edit Profile</h2>

    <form class="editProfileForm" method="POST">
      <section class="avatarUpload">
        <img class="profileAvatar" src="https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/great-ocean-road-174028267-1494616481.jpg" alt="User Avatar">
        <input type="file" placeholder="Upload New Image">
      </section>

      <section class="inputsWrapper">
        <div class='inputWrapper'>
          <label for='fname'>First Name</label>
          <input class='authInput' type='text' name='fname'>
        </div>

        <div class='inputWrapper'>
          <label for='lname'>Last Name</label>
          <input class='authInput' type='text' name='lname'  >
        </div>

        <div class='inputWrapper'>
          <label for='phone'>Phone</label>
          <input class='authInput' type='text' name='phone' >
        </div>

        <div class='inputWrapper'>
          <label for='email'>Email</label>
          <input class='authInput' type='text' name='email'  >
        </div>

        <div class='inputWrapper'>
          <label for='bio'>Bio (under 100 characters)</label>
          <textarea class='authTextarea' name="bio" cols="30" rows="10"></textarea>
        </div>

        <div class="editProfileBtns">
          <a class="editProfileCancel" href="profile.php">Cancel</a>
          <button class='mainBtn'>Save</button>
        </div>
      </section>  
    </form>
  </section>
</main>

<?php
  require_once "includes/footer.php";
?>