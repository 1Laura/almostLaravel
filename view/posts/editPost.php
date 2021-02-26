<h1>Editing post : <?php echo $id; ?></h1>

<a href="/posts" class="btn btn-dark my-3"><i class="fa fa-chevron-left"></i> Back</a>
<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="car card-body bg-light ">
            <!--            --><?php //flash('registerSuccess'); ?>
            <h2>Create Post</h2>
            <p>Share your thoughts with the world</p>
            <form action="" method="post">
                <div class="form-group">
                    <label for="title">Title: <sup>*</sup></label>
                    <input type="text" name="title" id="title"
                           class="<?php echo !empty($errors['titleErr']) ? 'is-invalid' : ''; ?> form-control form-control-lg"
                           value="<?php echo $title; ?>">
                    <span class="invalid-feedback"><?php echo $errors['titleErr']; ?></span>
                </div>

                <div class="form-group">
                    <label for="body">Your text: <sup>*</sup></label>
                    <textarea name="body" id="body"
                              class="<?php echo (!empty($errors['bodyErr'])) ? 'is-invalid' : ''; ?> form-control form-control-lg"><?php echo $body ?></textarea>
                    <span class="invalid-feedback"><?php echo $errors['bodyErr']; ?></span>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <input type="submit" class="btn btn-secondary w-100" value="Create">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
var_dump($title);
var_dump($body);
var_dump($_SESSION);


?>