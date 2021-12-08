<!--AUTHOR: RUN GUO-->

<?php
require_once "includes/header.php";
//get user info
$user = isset($_SESSION['user']) ? $_SESSION['user'] : '';
if (empty($user)) header('Location:index.php');
//edit profile
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = htmlspecialchars($_POST['fname']);
    $lname = htmlspecialchars($_POST['lname']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $bio = htmlspecialchars($_POST['bio']);
    $bio = substr($bio, 0, 100);

    $sql = 'update login set author_email ="'.$email.'" where author_id = ' . $login_id;
    $result1 = $conn->query($sql);
    $sql = 'update author set author_fname = "'.$fname.'", author_lname = "'.$lname.'", author_phone = "'.$phone.'", author_intro = "'.$bio.'" where login_id = ' . $login_id;
    $result2 = $conn->query($sql);
    if ($result1 && $result2) {
        header('Location:profile.php');die;
    } else {
        $error_msg = 'Modify profile fail.';
    }
}


?>
<!--AUTHOR: KENNEDY LANDRY-->
<!--THIS SECTION WILL LET THE USER EDIT THEIR PROFILE INFORMATION-->
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
          <input class='authInput' type='text' name='fname' value="<?php echo $user_info['author_fname']; ?>" >
        </div>

        <div class='inputWrapper'>
          <label for='lname'>Last Name</label>
          <input class='authInput' type='text' name='lname'  value="<?php echo $user_info['author_lname']; ?>" >
        </div>

        <div class='inputWrapper'>
          <label for='phone'>Phone</label>
          <input class='authInput' type='text' name='phone'  value="<?php echo $user_info['author_phone']; ?>" >
        </div>

        <div class='inputWrapper'>
          <label for='email'>Email</label>
          <input class='authInput' type='text' name='email' value="<?php echo $user_info['author_email']; ?>" >
        </div>

        <div class='inputWrapper'>
          <label for='bio'>Bio (under 100 characters)</label>
          <textarea class='authTextarea' name="bio" cols="30" rows="10"><?php echo $user_info['author_intro']; ?></textarea>
        </div>

        <div class="editProfileBtns">
          <a class="editProfileCancel" href="profile.php">Cancel</a>
          <button class='mainBtn'>Save</button>
        </div>
      </section>  
    </form>
  </section>
</main>

<!--AUTHOR: RUN GUO-->
<?php
  require_once "includes/footer.php";
?>