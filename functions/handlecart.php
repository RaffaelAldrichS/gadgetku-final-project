<?php

session_start();
include('../config/dbcon.php');

if (isset($_SESSION['auth'])) {
    if (isset($_POST['scope'])) {
        $scope = $_POST['scope'];
        switch ($scope) {
            case "add":
                $prod_id = $_POST['prod_id'];
                $prod_qty = $_POST['prod_qty'];

                $user_id = $_SESSION['auth_user']['user_id'];

                // Cek apakah produk sudah ada di keranjang
                $check_query = "SELECT * FROM carts WHERE user_id='$user_id' AND prod_id='$prod_id'";
                $check_query_run = mysqli_query($conn, $check_query);

                if (mysqli_num_rows($check_query_run) > 0) {
                    // Produk sudah ada di keranjang, update kuantitas
                    $cart_data = mysqli_fetch_array($check_query_run);
                    $new_qty = $cart_data['prod_qty'] + $prod_qty;

                    $update_query = "UPDATE carts SET prod_qty='$new_qty' WHERE user_id='$user_id' AND prod_id='$prod_id'";
                    $update_query_run = mysqli_query($conn, $update_query);

                    if ($update_query_run) {
                        echo 202; // Status untuk update sukses
                    } else {
                        echo 500; // Status untuk kesalahan
                    }
                } else {
                    // Produk belum ada di keranjang, tambahkan entri baru
                    $insert_query = "INSERT INTO carts (user_id, prod_id, prod_qty) VALUES ('$user_id', '$prod_id', '$prod_qty')";
                    $insert_query_run = mysqli_query($conn, $insert_query);

                    if ($insert_query_run) {
                        echo 201; // Status untuk insert sukses
                    } else {
                        echo 500; // Status untuk kesalahan
                    }
                }

                break;
            case 'update':
                $prod_id = $_POST['prod_id'];
                $prod_qty = $_POST['prod_qty'];

                $user_id = $_SESSION['auth_user']['user_id'];

                // Cek apakah produk sudah ada di keranjang
                $check_query = "SELECT * FROM carts WHERE user_id='$user_id' AND prod_id='$prod_id'";
                $check_query_run = mysqli_query($conn, $check_query);

                if (mysqli_num_rows($check_query_run) > 0) {
                    // Produk sudah ada di keranjang, update kuantitas
                    $update_query = "UPDATE carts SET prod_qty = '$prod_qty' WHERE prod_id = '$prod_id'";
                    $update_query_run = mysqli_query($conn, $update_query);
                    if ($update_query_run) {
                        echo 202;
                    } else {
                        echo 500;
                    }
                } else {
                    echo "Something went wrong";
                }
                break;
            case 'delete':
                $cart_id = $_POST['cart_id'];
                $user_id = $_SESSION['auth_user']['user_id'];

                // Cek apakah produk sudah ada di keranjang
                $check_query = "SELECT * FROM carts WHERE user_id='$user_id' AND id='$cart_id'";
                $check_query_run = mysqli_query($conn, $check_query);

                if (mysqli_num_rows($check_query_run) > 0) {
                    // Produk sudah ada di keranjang, update kuantitas
                    $delete_query = "DELETE FROM carts WHERE user_id='$user_id' AND id='$cart_id'";
                    $delete_query_run = mysqli_query($conn, $delete_query);
                    if ($delete_query_run) {
                        echo 200;
                    } else {
                        echo "Something went wrong";
                    }
                } else {
                    echo "Something went wrong";
                }
                break;
            default:
                echo 500; // Status untuk kesalahan
        }
    }
} else {
    echo 401; // Status untuk tidak terautentikasi
}
