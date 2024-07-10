<?php

session_start();
include('../config/dbcon.php');
function getAll($table)
{
    global $conn;

    $query = "SELECT * FROM $table";
    $query_run = mysqli_query($conn, $query);
    return $query_run;
}
function getAllOrders()
{
    global $conn;

    $query = "SELECT * FROM orders";
    $query_run = mysqli_query($conn, $query);
    return $query_run;
}

function getById($table, $id)
{
    global $conn;

    $query = "SELECT * FROM $table WHERE id = '$id'";
    $query_run = mysqli_query($conn, $query);
    return $query_run;
}

function checkTrackingNoValid($tracking_no)
{
    global $conn;

    $query = "SELECT * FROM orders WHERE tracking_no = '$tracking_no'";
    return mysqli_query($conn, $query);
}

function getProdOrder()
{
    global $conn;
    $tracking_no = $_GET['target'];

    $query = "SELECT p.image, p.name, oi.qty, p.selling_price  FROM orders as o, products as p, order_items as oi WHERE o.id=oi.order_id AND oi.prod_id=p.id AND o.tracking_no = '$tracking_no'";
    return mysqli_query($conn, $query);
}

function redirect($url, $message)
{
    $_SESSION['message'] = $message;
    header('Location: ' . $url);
}
