$(document).ready(function(){

    // add read later
    $('.read-later').click(function () {
        var blog_id = $(this).attr('data-blog-id');
        $.post('includes/read_later.php', {blog_id:blog_id, remove:0}, function (e) {
            data = JSON.parse(e);
            if (data.code == 1) {
                window.location.href = 'login.php';
                return;
            }
            if (data.code == 0) {
                location.reload();
                return;
            }
            alert(data.message);
        });
    });

    // remove read later
    $('.remove-read-later').click(function () {
        var blog_id = $(this).attr('data-blog-id');
        $.post('includes/read_later.php', {blog_id:blog_id, remove:1}, function (e) {
            data = JSON.parse(e);
            if (data.code == 1) {
                window.location.href = 'login.php';
                return;
            }
            if (data.code == 0) {
                location.reload();
                return;
            }
            alert(data.message);
        });
    });

    // follow
    $('#follow-author').click(function () {
        var author_id = $(this).attr('data-author-id');
        $.post('includes/follow.php', {author_id:author_id}, function (e) {
            data = JSON.parse(e);
            if (data.code == 1) {
                window.location.href = 'login.php';
                return;
            }
            alert(data.message);
        });
    });

    // search
    $('.do-search').click(function () {
        var keyword = $('[name="search"]').val();
        if (keyword.length == 0) {
            return;
        }
        window.location.href = 'index.php?keyword=' + keyword;
    });

    $('.search-form').submit(function(e) {
      e.preventDefault();
      var keyword = $('[name="search"]').val();
      if (keyword.length == 0) {
          return;
      }
      window.location.href = 'index.php?keyword=' + keyword;
    })
});