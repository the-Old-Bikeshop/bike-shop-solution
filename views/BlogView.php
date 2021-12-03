<?php
$post = new PostController();
$post->setPost();

?>

<?php include_once "./components/customerNavigation.php"?>
<div class="blog-posts-view-wrapper">
    <div class="blog-posts-view-heading-wrapper">
        <div class="blog-posts-view-heading-icon-wrapper">
            <i class="las la-newspaper"></i>
        </div>
        <h1 class="blog-posts-view-heading">Blog Posts</h1>
    </div>
    <div class="blog-posts-wrapper">
    <?php foreach ($post->fetchAllPosts() as $res): ?>
        <div class="blog-post-container">
            <div class="blog-post-text-wrapper">   
                <h1 class="blog-post-heading">
                    <?php echo $res['title']?>
                </h1>
                <p class="blog-post-text">
                    <?php echo $res['content']?>
                </p>
                <div class="post-chips-container">
                    <div class="post-chip">
                        cheap-transportation
                    </div>
                    <div class="post-chip">
                        city-bike
                    </div>
                    <div class="post-chip">
                        green-world
                    </div>
                </div>
                <div class="blog-post-icon">
                    <i class="las la-arrow-right"></i>
                </div>
            </div>
            <div class="blog-post-image-wrapper">
            </div>
        </div>
    <?php endforeach ?>
    </div>
    <?php include_once "./components/assuranceBanner.php"?>
</div>
<?php include_once "./components/baseFooter.php"?>