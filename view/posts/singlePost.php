<h1>Single post template</h1>
<!--<h2>Param : --><?php //echo $id; ?><!--</h2>-->


<a href="/posts" class="btn btn-light my-3"><i class="fa fa-chevron-left"></i> Back</a>
<h1><?php echo $post->title; ?></h1>
<div class="bg-secondary text-white p-2 mb-3">
    Written by: <strong><?php echo $user->name; ?></strong>
    On: <?php echo $post->created; ?>
</div>
<p class="lead"><?php echo $post->body; ?></p>


<!--show this only if this post belongs to this user-->
<?php //if ($_SESSION['userId'] === $data['post']->userId) : ?>
<hr>
<a href="<?php echo "/post/edit/" . $post->postId; ?>" class="btn btn-secondary"><i
            class="fa fa-pencil"></i> EDIT </a>

<form action="<?php echo '/post/delete/' . $post->postId ?>" method="post" class="float-end">
    <button type="submit" class="btn btn-danger"><i class="fa fa-close"></i> DELETE</button>
</form>
<?php //endif; ?>