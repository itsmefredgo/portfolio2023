<!--AUTHOR: RUN GUO-->

<!--INSERTING COMMENT DATA TO DATABASE-->
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();
    require_once '../db/connect.php';
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        $login_id = $user['user_login_id'];
        $sql = 'select author.*,login.author_email from author join login on author.login_id = login.author_id where author.login_id = ' . $login_id;
        $result = $conn->query($sql);
        $user_info = $result->fetch_assoc();
    }
    if (!isset($login_id)) {
        header('Location:../login.php');
        die;
    }
    $blog_id = intval($_POST['blog_id']);
    $content = htmlspecialchars($_POST['content']);

    $sql = 'insert into comment (`author_id`, `blog_id`, `comment_content`, `create_time`) value ('.$login_id.', '.$blog_id.', "'.$content.'", '.time().')';
    $result = $conn->query($sql);
    if ($result) {
        header('Location:../blog.php?blog_id=' . $blog_id);
    } else {
        header('Location:index.php');
    }
}