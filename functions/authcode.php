<?php

session_start();
include('../config/dbcon.php');
include('./myFunctions.php');

if (isset($_POST["register_btn"])) {
    $user_name = mysqli_real_escape_string($conn, $_POST["user_name"]);
    $user_phone = mysqli_real_escape_string($conn, $_POST["user_phone"]);
    $user_email = mysqli_real_escape_string($conn, $_POST["user_email"]);
    $user_password = mysqli_real_escape_string($conn, $_POST["user_password"]);
    $user_password2 = mysqli_real_escape_string($conn, $_POST["user_password2"]);

    // Check if email already exists
    $check_email = "SELECT user_email FROM users WHERE user_email = '$user_email'";
    $check_email_run = mysqli_query($conn, $check_email);
    if (mysqli_num_rows($check_email_run) > 0) {
        $_SESSION['message'] = 'Email already registered';
        header('Location: ../register.php');
        exit();
    } else {
        // Check password match
        if ($user_password == $user_password2) {
            // Hash the password
            $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

            $insert_query = "INSERT INTO users (user_name, user_phone, user_email, user_password) VALUES ('$user_name', '$user_phone', '$user_email', '$hashed_password')";
            $insert_query_run = mysqli_query($conn, $insert_query);

            if ($insert_query_run) {
                redirect('../login.php', "Registered Successfully");
            } else {
                redirect('../register.php', 'Something went wrong');
            }
        } else {
            redirect('../register.php', 'Passwords do not match');
        }
    }
} else if (isset($_POST['login_btn'])) {
    $email = mysqli_real_escape_string($conn, $_POST['user_email']);
    $password = mysqli_real_escape_string($conn, $_POST['user_password']);

    $login_query = "SELECT * FROM users WHERE user_email = '$email'";
    $login_query_run = mysqli_query($conn, $login_query);

    if (mysqli_num_rows($login_query_run) > 0) {
        $userdata = mysqli_fetch_array($login_query_run);
        $db_password = $userdata['user_password'];

        if (password_verify($password, $db_password)) {
            $_SESSION['auth'] = true;

            $user_id = $userdata['id'];
            $username = $userdata['user_name'];
            $useremail = $userdata['user_email'];
            $role_as = $userdata['role_as'];

            $_SESSION['auth_user'] = [
                'user_id' => $user_id,
                'name' => $username,
                'email' => $useremail
            ];

            //  Check role (login as admin or user)
            $_SESSION['role_as'] = $role_as;
            if ($role_as == 1) {
                redirect('../admin/index.php', 'Welcome to dashboard');
            } else {
                redirect('../index.php', 'Logged In Successfully');
            }
        } else {
            redirect('../login.php', 'Invalid email / password');
        }
    } else {
        redirect('../login.php', 'User not found');
    }
}
