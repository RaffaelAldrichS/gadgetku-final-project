<?php

include('./myFunctions.php');

if (isset($_SESSION['auth'])) {
    if (isset($_POST['placeOrderBtn'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $total_price = mysqli_real_escape_string($conn, $_POST['total_price']);
        $payment_mode = mysqli_real_escape_string($conn, $_POST['payment_mode']);
        // $payment_id = mysqli_real_escape_string($conn, $_POST['payment_id']);

        $tracking_no = "order" . uniqid() . rand(1111, 9999);
        $user_id = $_SESSION['auth_user']['user_id'];
        if ($name == "" || $email == "" || $phone == "" || $pincode == "" || $address == "") {
            redirect('../checkout.php', 'All fields are mandatory');
        }

        $query = "SELECT c.id as cid, c.prod_id, c.prod_qty, p.id as pid, p.name, p.image, p.selling_price FROM carts c, products p WHERE c.prod_id = p.id AND c.user_id = $user_id ORDER BY c.id DESC";
        $query_run = mysqli_query($conn, $query);

        $insert_query = "INSERT INTO orders (tracking_no, user_id, name, email, phone, address, pincode, total_price, payment_mode, payment_id) VALUES ('$tracking_no', '$user_id', '$name', '$email', '$phone', '$address', '$pincode', '$total_price', '$payment_mode', '')";

        $insert_query_run = mysqli_query($conn, $insert_query);

        if ($insert_query_run) {
            $order_id = mysqli_insert_id($conn);
            foreach ($query_run as $item) {
                $prod_id = $item['prod_id'];
                $prod_qty = $item['prod_qty'];
                $price = $item['selling_price'];
                $insert_items_query = "INSERT INTO order_items (order_id, prod_id, qty, price) VALUES ('$order_id', '$prod_id', '$prod_qty', '$price')";
                $insert_items_query_run = mysqli_query($conn, $insert_items_query);

                // Update product qty
                $product_query = "SELECT * FROM products WHERE id = '$prod_id' LIMIT 1";
                $product_query_run = mysqli_query($conn, $product_query);
                $product_data = mysqli_fetch_array($product_query_run);

                $current_qty = $product_data['qty'] - $prod_qty;
                $update_qty_query = "UPDATE products SET qty = '$current_qty' WHERE id = '$prod_id'";
                $update_qty_query_run = mysqli_query($conn, $update_qty_query);
            }
            $delete_cart_query = "DELETE FROM carts WHERE user_id ='$user_id'";
            $delete_cart_query_run = mysqli_query($conn, $delete_cart_query);
            redirect('../myOrders.php', 'Order placed successfully');
        }
    } else {
        redirect('../checkout.php', 'Check order');
    }
} else {
    redirect('../index.php', 'Login to continue');
}
