<div class="row">
    <div class="col-lg-6 mx-auto">
        <div class="car card-body bg-light mt-5">
            <!--            --><?php //flash('registerSuccess'); ?>
            <h2>Login</h2>
            <p>PLease fill in the form to register with us</p>
            <form action="" method="post">
                <div class="form-group">
                    <label for="email">Email: <sup>*</sup></label>
                    <input type="text" name="email" id="email"
                           class="<?php echo !empty($errors['emailErr']) ? 'is-invalid' : ''; ?> form-control form-control-lg"
                           value="<?php echo $email; ?>">
                    <span class="invalid-feedback"><?php echo $errors['emailErr']; ?></span>
                </div>

                <div class="form-group">
                    <label for="password">Password: <sup>*</sup></label>
                    <input type="password" name="password" id="password"
                           class="<?php echo !empty($errors['passwordErr']) ? 'is-invalid' : ''; ?> form-control form-control-lg"
                           value="<?php echo $password; ?>">
                    <span class="invalid-feedback"><?php echo $errors['passwordErr']; ?></span>
                </div>

                <div class="row mt-3">
                    <div class="col">
                        <input type="submit" class="btn btn-secondary w-100" value="login">
                    </div>
                    <div class="col">
                        <a href="/register" class="btn btn-light w-100">No account?
                            Register</a>
                    </div>

                </div>
            </form>
        </div>
    </div>
    <!--    --><?php //phpinfo(); ?>
</div>
