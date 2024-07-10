<?php

session_start();
include('./config/dbcon.php');
function getAllActive($table)
{
    global $conn;

    $query = "SELECT * FROM $table WHERE status = '0'";
    $query_run = mysqli_query($conn, $query);
    return $query_run;
}
function getCatActive($limit)
{
    global $conn;

    $query = "SELECT name,slug,image FROM categories WHERE status = '0' LIMIT $limit";
    $query_run = mysqli_query($conn, $query);
    return $query_run;
}

function getAllTrending()
{
    global $conn;

    $query = "SELECT * FROM products WHERE trending = '1'";
    $query_run = mysqli_query($conn, $query);
    return $query_run;
}

function getSlugActive($table, $slug)
{
    global $conn;

    $query = "SELECT * FROM $table WHERE slug = '$slug' AND status = '0' LIMIT 1";
    $query_run = mysqli_query($conn, $query);
    return $query_run;
}

function getProdByCatActive($id)
{
    global $conn;

    $query = "SELECT * FROM products WHERE category_id = '$id' AND status = '0'";
    $query_run = mysqli_query($conn, $query);
    return $query_run;
}

function getIdActive($table, $id)
{
    global $conn;

    $query = "SELECT * FROM $table WHERE id = '$id' AND status = '0";
    $query_run = mysqli_query($conn, $query);
    return $query_run;
}

function getCartItems()
{
    global $conn;
    $user_id = $_SESSION['auth_user']['user_id'];
    $query = "SELECT c.id as cid, c.prod_id, c.prod_qty, p.id as pid, p.name, p.image, p.selling_price FROM carts c, products p WHERE c.prod_id = p.id AND c.user_id = $user_id ORDER BY c.id DESC";
    $query_run = mysqli_query($conn, $query);
    return $query_run;
}

function getOrders()
{
    global $conn;
    $user_id = $_SESSION['auth_user']['user_id'];
    $query = "SELECT * FROM orders WHERE user_id = '$user_id'ORDER BY id DESC";
    $query_run = mysqli_query($conn, $query);
    return $query_run;
}

function redirect($url, $message)
{
    $_SESSION['message'] = $message;
    header('Location: ' . $url);
}

function checkTrackingNoValid($tracking_no)
{
    global $conn;
    $user_id = $_SESSION['auth_user']['user_id'];

    $query = "SELECT * FROM orders WHERE tracking_no = '$tracking_no' AND user_id = '$user_id'";
    return mysqli_query($conn, $query);
}

function getProdOrder()
{
    global $conn;
    $tracking_no = $_GET['target'];
    $user_id = $_SESSION['auth_user']['user_id'];

    $query = "SELECT p.image, p.name, oi.qty, p.selling_price  FROM orders as o, products as p, order_items as oi WHERE o.user_id = '$user_id' AND o.id=oi.order_id AND oi.prod_id=p.id AND o.tracking_no = '$tracking_no'";
    return mysqli_query($conn, $query);
}
