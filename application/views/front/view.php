<?php include APPPATH."/views/layouts/front/header.php"; ?>
<!-- Page Header -->
<!-- Set your background image for this header on the line below. -->
<header class="intro-header" style="background-image: url('/assets/img/post-bg.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="post-heading">
                    <h1><?php echo $post['title']; ?></h1>
                    <span class="meta">Posted by <a href="#">Start Bootstrap</a> on August 24, 2014</span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Post Content -->
<article>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <p>
                    <?php echo $post['post']; ?>
                </p>
            </div>
        </div>
    </div>
</article>
<?php include APPPATH."/views/layouts/front/footer.php"; ?>