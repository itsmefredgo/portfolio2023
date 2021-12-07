<?php
require_once "includes/header.php";

function get_file_name($len) {
    $new_file_name = 'S_';
    $chars = "1234567890qwertyuiopasdfghjklzxcvbnm";
    for ($i = 0; $i < $len; $i++) {
        $new_file_name .= $chars[mt_rand(0, strlen($chars) - 1)];
    }
    return $new_file_name;
}
$upload_path = 'upload';
if (!file_exists($upload_path)) {
    mkdir($upload_path);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = htmlspecialchars($_POST['title']);
    $tags = htmlspecialchars($_POST['tags']);
    $content = htmlspecialchars($_POST['content']);
    $file = $_FILES['file'];

    $file_name = $file['name'];
    $ext = explode(".", $file_name);
    $ext = $ext[count($ext) - 1];
    $new_name = get_file_name(6).'.'.$ext;
    $upload_path = 'upload';
    if (!file_exists($upload_path)) {
        mkdir($upload_path);
    }
    $path = $upload_path . '/' . $new_name;
    if (move_uploaded_file($file['tmp_name'], $path)) {
        //Insert blog
        $sql = 'insert into blog (`blog_title`, `blog_preview`, `blog_content`, `author_id`, `create_time`) value ("'.$title.'", "'.$path.'", "'.$content.'", "'.$login_id.'", "'.time().'")';
        $conn->query($sql);
        $blog_id = $conn->insert_id;
        //insert tag
        if (!empty($tags)) {
            $tags = explode(',', $tags);
            foreach ($tags as $val) {
                //check tag exists
                $sql = 'select * from tag where tag_label = "'.$val.'"';
                $res = $conn->query($sql);
                $res = $res->fetch_assoc();
                if (empty($res)) {
                    $sql = 'insert into tag (`tag_label`) value("'.$val.'")';
                    $conn->query($sql);
                    $tag_id = $conn->insert_id;
                } else {
                    $tag_id = $res['tag_id'];
                }

                $sql = 'insert into blogtag (`tag_id`, `blog_id`) value ('.$tag_id.', '.$blog_id.')';
                $conn->query($sql);
            }
        }
    }
    header('Location:index.php');die;
}

// get tags
$sql  = 'select * from tag';
$res = $conn->query($sql);
$tags = [];
while ($t = $res->fetch_assoc()) {
    $tags[] = $t;
}
?>

<!--THIS SECTION LETS THE USER CREATE A BLOG. USER CAN FILL OUT THE FORM AND HIT SIBMIT BUTTON TO TOGGLE SQL INPUT FUNCTION-->
<main>
    <h6>Create Blog</h6>

    <form class="form-horizontal" enctype="multipart/form-data" method="post" action="create.php">
        <div class="form-group">
            <label for="title" class="col-sm-2 control-label">Title</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="title" name="title" placeholder="Input your post title">
            </div>
        </div>
        <div class="form-group">
            <label for="tags" class="col-sm-2 control-label">Tags</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputEmail3" name="tags" placeholder="Newtags,seperate by ','">
            </div>
        </div>

        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Upload</label>
            <div class="col-sm-10">
                <input id="input-id" name="file"  type="file" data-show-caption="true">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Input you Post</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="20" placeholder="Please input your post" name="content"></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10 text-center">
                <button type="submit" class="btn btn-default mr20">Post</button>
                <button type="botton" class="btn btn-default ml20">Cancel</button>
            </div>
        </div>
    </form>
</main>

<?php
require_once "includes/footer.php";
?>