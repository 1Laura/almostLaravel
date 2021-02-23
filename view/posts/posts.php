
<div class="row">
    <div class="col">
        <h1>Posts</h1>
        <?php // echo flash('post_message'); ?>
    </div>
    <div class="col">
        <a href="/posts/add" class="btn btn-primary pull-right mt-2">
            <i class="fa fa-pencil"></i>
            Add post
        </a>
    </div>
</div>

<div class="row">
    <?php foreach ($posts as $post) :  ?>
        <div class="col-md-6">
            <div class="card mb-2">
                <div class="card-body">
                    <h4 class="card-title"><?php echo $post->title ?></h4>
                    <p class="bg-light p-2 mb-3"> Written By <?php echo $post->name ?></p>
                    <p class="card-text"><?php echo $post->body ?></p>
                    <a href="<?php echo '/posts/show/' . $post->postId; ?>" class="card-link">Read more</a>
                </div>
                <div class="card-footer">Created at: <?php echo $post->postCreated ?></div>
            </div>
        </div>
    <?php endforeach; ?>

</div>
