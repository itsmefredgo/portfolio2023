<?php
require_once "includes/header.php";
include("includes/functions.php");

// get tags
$sql  = 'select * from tag';
$res = $conn->query($sql);
$tags = [];
while ($t = $res->fetch_assoc()) {
    $tags[] = $t;
}

// get blog detail
$blog_id = isset($_GET['blog_id']) ? intval($_GET['blog_id']) : 0;
if (empty($blog_id)) header('Location:index.php');

$sql = 'select blog.*, author.author_fname, author.author_lname from blog join author on blog.author_id = author.login_id where blog_id = ' . $blog_id;
$result = $conn->query($sql);
$blog_info = $result->fetch_assoc();

// get comments
$sql = 'select comment.*, author.author_fname, author.author_lname from comment join author on comment.author_id = author.login_id  where blog_id = ' . $blog_id . ' order by comment_id desc';
$result = $conn->query($sql);
$comments = [];
while ($row = $result->fetch_assoc()) {
    $comments[] = $row;
}

?>

<main>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-lg-9 col-md-9">
            <h6>Main Blog</h6>
            <div class='row p20'>
                <div class="col-xs-12 col-sm-12 col-lg-12 col-md-12">
                    <img src="<?php echo $blog_info['blog_preview']; ?>" style="width:100%;padding: 50px;">
                </div>
                <div class="col-xs-12 col-sm-12 col-lg-12 col-md-12">
                    <div class="mt20">
                        <div class="pull-left">
                            <p class="blog-title"><?php echo $blog_info['blog_title']; ?></p>
                            <div class="flex">
                                <p class="mr20"><a href="other.php?author=<?php echo $blog_info['author_id']; ?>"><?php echo $blog_info['author_fname'].' ' . $blog_info['author_lname']; ?></a></p>
                                <p class="text-muted ml20"><?php echo date('Y-m-d H:i', $blog_info['create_time']); ?></p>
                            </div>
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-default ml20 read-later" href="javascript:void(0)" data-blog-id="<?php echo $blog_info['blog_id']; ?>">Read later</a>
                        </div>
                        <p class="clearfix"></p>

                    </div>
                    <p class="text-muted  word-break">
                        <?php echo $blog_info['blog_content']; ?>
                    </p>
                </div>
            </div>
            <hr>

            <div class="p20">
                <h3 class="blog-title mb20">Comments</h3>
                <?php foreach ($comments as $value) { ?>
                <div class="comments">
                    <div class="flex">
                        <p class="mr20"><a href="other.php?author=<?php echo $value['author_id']; ?>"><?php echo $value['author_fname'].' ' . $value['author_lname']; ?></a></p>
                        <p class="text-muted ml20"><?php echo date('Y-m-d H:i', $value['create_time']); ?></p>
                    </div>
                    <p class="text-follow-5 text-muted"><?php echo $value['comment_content']; ?></p>
                </div>
                <hr>
                <?php } ?>
            </div>
            <form role="form" class="form-horizontal p20" action="includes/comment.php" method="post">
                <div class="form-group">
                    <textarea class="form-control" rows="5" placeholder="Write comments about the post" name="content"></textarea>
                    <input type="hidden" name="blog_id" value="<?php echo $blog_id; ?>">
                </div>
                <button class="btn btn-default btn-sm pull-right" >Write Comments</button>

            </form>
            <hr>
        </div>
        <div class="col-xs-12 col-sm-12 col-lg-3 col-md-3 p20">
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
