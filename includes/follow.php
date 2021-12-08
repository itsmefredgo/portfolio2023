<!--AUTHOR: RUN GUO-->

<!--IMPLEMENTING FOLLOW AUTHOR(S) FUNCTION IN THE MAIN PAGE-->

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
        $data = [
            'code' => 1,
            'message' => 'Please login first.',
        ];
        die(json_encode($data));
    }
    $author_id = intval($_POST['author_id']);
    if ($author_id == $login_id) {
        $data = [
            'code' => 500,
            'message' => 'Do not follow self.',
        ];
        die(json_encode($data));
    }
    // follow is exists
    $sql = 'select * from follow where author_id = ' . $login_id . ' and follow_author_id = ' . $author_id;
    $result = $conn->query($sql);
    $result = $result->fetch_assoc();
    if (!empty($result)) {
        $data = [
            'code' => 500,
            'message' => 'Fail,has followed.',
        ];
        die(json_encode($data));
    }

    $sql = 'insert into follow (`author_id`, `follow_author_id`) value ('.$login_id.', '.$author_id.')';
    $result = $conn->query($sql);
    if ($result) {
        $data = [
            'code' => 0,
            'message' => 'Success',
        ];
        die(json_encode($data));
    } else {
        $data = [
            'code' => 500,
            'message' => 'Fail',
        ];
        die(json_encode($data));
    }
}