<?php

$currentPage = 'register';
session_start();

//Check if user already logged in
if (isset($_SESSION['auth'])) {
    $_SESSION['message'] = 'You\'re already logged in';
    header('Location: index.php');
    exit();
}

include('./includes/header.php');
?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <?php if (isset($_SESSION['message'])) : ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Hey!</strong> <?= $_SESSION['message'] ?>.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                    </div>
                <?php unset($_SESSION['message']);
                endif ?>
                <div class="card">
                    <div class="card-header">
                        <h4>Registration Form</h4>
                    </div>
                    <div class="card-body">
                        <form action="functions/authcode.php" method="post">
                            <div class="mb-3">
                                <label for="user_name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Enter your name">
                            </div>
                            <div class="mb-3">
                                <label for="user_phone" class="form-label">Phone</label>
                                <input type="number" class="form-control" id="user_phone" name="user_phone" placeholder="Enter your phone number">
                            </div>
                            <div class="mb-3">
                                <label for="user_email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Enter your email">
                            </div>
                            <div class="mb-3">
                                <label for="user_password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="user_password" name="user_password" placeholder="Enter password">
                            </div>
                            <div class="mb-3">
                                <label for="user_password2" form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="user_password2" name="user_password2" placeholder="Confirm password">
                            </div>
                            <button type="submit" name="register_btn" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('./includes/footer.php'); ?>