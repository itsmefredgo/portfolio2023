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
    $blog_id = intval($_POST['blog_id']);
    $remove = intval($_POST['remove']);
    if ($remove) {
        // remove read later
        $sql = 'delete from read_later where author_id = ' . $login_id . ' and blog_id = ' . $blog_id;
        $conn->query($sql);
        if ($conn->affected_rows) {
            $data = [
                'code' => 0,
                'message' => 'Remove success',
            ];
        } else {
            $data = [
                'code' => 500,
                'message' => 'Remove fail',
            ];
        }
        die(json_encode($data));
    }
    // read later is exists
    $sql = 'select * from read_later where author_id = ' . $login_id . ' and blog_id = ' . $blog_id;
    $result = $conn->query($sql);
    $result = $result->fetch_assoc();
    if (!empty($result)) {
        $data = [
            'code' => 500,
            'message' => 'Fail,has added.',
        ];
        die(json_encode($data));
    }

    $sql = 'insert into read_later (`author_id`, `blog_id`) value ('.$login_id.', '.$blog_id.')';
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