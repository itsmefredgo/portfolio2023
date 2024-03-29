<!--AUTHOR: RUN GUO, MERGING PHP FILES-->

<?php
require_once "includes/header.php";

//get profile info
$author = isset($_GET['author']) ? intval($_GET['author']) : 0;
if (empty($author)) {
    header('Location:index.php');
    die;
}
$sql = 'select author.*,login.author_email from author join login on author.login_id = login.author_id where author.login_id = ' . $author;
$result = $conn->query($sql);
$user_info = $result->fetch_assoc();

//get recent blogs
$data = [];
$sql = 'select blog.*,author.author_fname, author.author_lname from blog join author on blog.author_id = author.login_id where blog.author_id = '.$author.' order by blog.blog_id desc limit 2';
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
?>

<!--AUTHOR: RUN GUO-->
<!--EDITOR: BEN HOEG-->
<!--THIS SECTION PRINTS INFORMATION OF THE AUTHOR SELECTED-->
<main>
    <section class="profile">
        <h2 class="sectionHeader">Author Profile</h2>

        <div class="userDetails">
            <img class="profileAvatar" src="https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/great-ocean-road-174028267-1494616481.jpg" alt="User Avatar">

            <div class="userInfoWrapper">
                <div class="userInfoTop">
                    <span class="userName"><?php echo $user_info['author_fname'] . ' ' . $user_info['author_lname'];?></span>
                    <?php
                    ?>
                    <a class="editProfileLink" href="javascript:void(0)" id="follow-author" data-author-id="<?php echo $author; ?>">Follow Author</a>
                </div>

                <div class="userInfo">
                    <span>Phone: <?php echo $user_info['author_phone']; ?></span>
                    <span>Email: <?php echo $user_info['author_email']; ?></span>
                    <span><?php echo $user_info['author_intro']; ?></span>
                </div>
            </div>
        </div>
    </section>

<!--AUTHOR: RUN GUO-->
<!--EDITOR: FREDERICK GO-->
<!--EDITOR: KENNEDY LANDRY-->
<!--THIS SECTION PRINTS ALL BLOGS CREATED BY THE AUTHOR SELECTED-->
    <section class="recentBlogs">
        <h2 class="sectionHeader">Recent Blogs</h2>
        <hr>
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
                        <a class="btn btn-default ml20 read-later" href="javascript:void(0)" data-blog-id="<?php echo $value['blog_id']; ?>">Read later</a>
                    </div>
                </div>
            </div>
            <hr>
        <?php } ?>
    </section>
</main>

<?php
  require_once "includes/footer.php";
?>