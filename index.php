<?php
require_once "includes/header.php";

// get tags
$sql  = 'select * from tag';
$res = $conn->query($sql);
$tags = [];
while ($t = $res->fetch_assoc()) {
    $tags[] = $t;
}

$tab = isset($_GET['tab']) ? intval($_GET['tab']) : 1;
$tag = isset($_GET['tag']) ? htmlspecialchars($_GET['tag']) : '';
$keyword = isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '';
$data = [];
//THIS SECTION PRINTS BLOGS OF FOLLOWING AUTHORS ONLY, AVAILALBE FUNCTION TO LOGGED IN USERS ONLY
switch ($tab) {
    case 2:
        //get follow blogs
        $author_ids = [];
        if (isset($login_id)) {
            $sql = 'select * from follow where author_id = ' . $login_id;
            $result = $conn->query($sql);
            while ($rl = $result->fetch_assoc()) {
                $author_ids[] = $rl['follow_author_id'];
            }
            if (!empty($author_ids)) {
                $sql = 'select blog.*,author.author_fname, author.author_lname from blog join author on blog.author_id = author.login_id where blog.author_id in (' . join(',', $author_ids) . ') order by blog.blog_id desc';
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    //get tags
                    $blog_id = $row['blog_id'];
                    $sql = 'select tag.tag_label from blogtag join tag on blogtag.tag_id = tag.tag_id where blogtag.blog_id = ' . $blog_id;
                    $blog_tags = [];
                    $res = $conn->query($sql);
                    while ($t = $res->fetch_assoc()) {
                        $blog_tags[] = $t['tag_label'];
                    }
                    $row['tags'] = $blog_tags;
                    $data[] = $row;
                }
            }
        }
        break;

//THIS SECTION PRINTS BLOGS THAT ARE MARKED AS READ_LATER, AVAILALBE FUNCTION TO LOGGED IN USERS ONLY
    case 3:
        //get read later blogs
        $blog_ids = [];
        if (isset($login_id)) {
            $sql = 'select * from read_later where author_id = ' . $login_id;
            $result = $conn->query($sql);
            while ($rl = $result->fetch_assoc()) {
                $blog_ids[] = $rl['blog_id'];
            }
            if (!empty($blog_ids)) {
                $sql = 'select blog.*,author.author_fname, author.author_lname from blog join author on blog.author_id = author.login_id where blog.blog_id in (' . join(',', $blog_ids) . ') order by blog.blog_id desc';
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    //get tags
                    $blog_id = $row['blog_id'];
                    $sql = 'select tag.tag_label from blogtag join tag on blogtag.tag_id = tag.tag_id where blogtag.blog_id = ' . $blog_id;
                    $blog_tags = [];
                    $res = $conn->query($sql);
                    while ($t = $res->fetch_assoc()) {
                        $blog_tags[] = $t['tag_label'];
                    }
                    $row['tags'] = $blog_tags;
                    $data[] = $row;
                }
            }
        }

        break;
    default:

    //IF NOTHING IS SELECTED, PRINTS ALL RECENT BLOGS. AVAILABLE TO ALL USERS.
        //get all blogs
        $sql = 'select blog.*,author.author_fname, author.author_lname from blog join author on blog.author_id = author.login_id order by blog.blog_id desc';
        if (!empty($keyword)) {
            $sql = 'select blog.*,author.author_fname, author.author_lname from blog join author on blog.author_id = author.login_id where blog.blog_title like "%'.$keyword.'%" order by blog.blog_id desc';
        }
        if (!empty($tag)) {
            $tag_sql = 'select blogtag.blog_id from blogtag join tag on blogtag.tag_id = tag.tag_id where tag.tag_label = "' . $tag . '"';
            $tag_res = $conn->query($tag_sql);
            $blog_ids = [];
            while ($bt = $tag_res->fetch_assoc()) {
                $blog_ids[] = $bt['blog_id'];
            }
            if (!empty($blog_ids)){
                $sql = 'select blog.*,author.author_fname, author.author_lname from blog join author on blog.author_id = author.login_id where blog.blog_id in (' . join(',', $blog_ids) . ') order by blog.blog_id desc';
            }
        }
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            //get tags
            $blog_id = $row['blog_id'];
            $sql = 'select tag.tag_label from blogtag join tag on blogtag.tag_id = tag.tag_id where blogtag.blog_id = ' . $blog_id;
            $blog_tags = [];
            $res = $conn->query($sql);
            while ($t = $res->fetch_assoc()) {
                $blog_tags[] = $t['tag_label'];
            }
            $row['tags'] = $blog_tags;
            $data[] = $row;
        }
//      var_dump($data);
        break;
}


?>

<!--THIS SECTION PRINTS AND ITERACTS WITH THE USER WITH TAG FUNCTION-->
<main>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-lg-9 col-md-9">
            <?php if (isset($login_id)) { ?>
            <div class="text-muted tab-box row">
                <div class="p10 b-r-ddd ml10 col-xs-4 col-sm-4 col-lg-3 col-md-3 text-center <?php if ($tab==1) echo "tab-active"; ?>"> <a href="index.php?tab=1" >Recommended</a></div>
                <div class="p10 b-r-ddd  ml10 col-xs-3 col-sm-3 col-lg-3 col-md-3 text-center <?php if ($tab==2) echo "tab-active"; ?>"> <a href="index.php?tab=2" >Following</a></div>
                <div class="p10 ml10 col-xs-3 col-sm-3 col-lg-3 col-md-3 text-center <?php if ($tab==3) echo "tab-active"; ?>"> <a href="index.php?tab=3" >Read Later</a></div>
            </div>
            <?php } ?>
            <div class="blog-list-box">
                <?php foreach ($data as $value) { ?>
                <div class='row p20'>
                    <div class="col-xs-12 col-sm-12 col-lg-5 col-md-5">
                        <img src="<?php echo $value['blog_preview'] ?>" style="width:100%;max-height: 250px;">
                    </div>
                    <div class="col-xs-12 col-sm-12 col-lg-7 col-md-7">
                        <h4><?php echo $value['blog_title']; ?></h4>
                        <div class="">
                            <p class="pull-left">
                                <?php foreach ($value['tags'] as $v) { ?>
                                <span class="mr10">#<?php echo $v; ?></span>
                                <?php } ?>
                            </p>
                            <p class="pull-right ml10 text-muted"><?php echo date('Y-m-d H:i', $value['create_time']); ?></p>
                            <p class="pull-right "><a href="other.php?author=<?php echo $value['author_id']; ?>"><?php echo $value['author_fname'].' ' . $value['author_lname']; ?></a></p>
                        </div>
                        <p class="clearfix"></p>
                        <p class="text-follow-5 text-muted"><?php echo $value['blog_content']; ?></p>
                        <div class="flex mt10">
                            <a class="btn btn-default" href="blog.php?blog_id=<?php echo $value['blog_id']; ?>" >Read the full blog</a>
                            <?php if ($tab != 3) { ?>
                            <a class="btn btn-default ml20 read-later" href="javascript:void(0)" data-blog-id="<?php echo $value['blog_id']; ?>">Read later</a>
                            <?php } else { ?>
                            <a class="btn btn-default ml20 remove-read-later" href="javascript:void(0)" data-blog-id="<?php echo $value['blog_id']; ?>">Remove</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <hr>
                <?php } ?>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-lg-3 col-md-3">
<!--USER CAN CLICK HERE TO CREATE A BLOG-->
            <div >
                <a class="btn btn-default btn-sm" href="create.php">Create my Blog  <i class="glyphicon glyphicon-plus ml10"></i></a>
            </div>
            <h3>Tags</h3>
            <div class="row flex flex-warp">
                <?php foreach ($tags as $value) { ?>
                    <div class="mt10 ml20"><a href="index.php?tag=<?php echo $value['tag_label']; ?>">#<?php echo $value['tag_label']; ?></a></div>
                <?php } ?>
            </div>
        </div>
    </div>
</main>

<?php
  require_once "includes/footer.php";
?>