<?php

include('../config/dbcon.php');
include('../functions/myFunctions.php');

if (isset($_POST['add_category_btn'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $slug = mysqli_real_escape_string($conn, $_POST['slug']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $meta_title = mysqli_real_escape_string($conn, $_POST['meta_title']);
    $meta_description = mysqli_real_escape_string($conn, $_POST['meta_description']);
    $meta_keywords = mysqli_real_escape_string($conn, $_POST['meta_keywords']);
    $status = isset($_POST['status']) ? '1' : '0';
    $popular = isset($_POST['popular']) ? '1' : '0';

    $image = $_FILES['image']['name'];
    $path = "../uploads";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = uniqid() . '.' . $image_ext;

    $category_query = "INSERT INTO categories (name, slug, description, meta_title, meta_description, meta_keywords, status, image, popular) VALUES ('$name', '$slug', '$description', '$meta_title', '$meta_description', '$meta_keywords', '$status', '$filename', '$popular')";
    $category_query_run = mysqli_query($conn, $category_query);

    if ($category_query_run) {
        move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $filename);
        redirect('./addCategory.php', 'Category added successfully');
    } else {
        redirect('./addCategory.php', 'Something went wrong');
    }
} else if (isset($_POST['update_category_btn'])) {
    $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $slug = mysqli_real_escape_string($conn, $_POST['slug']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $meta_title = mysqli_real_escape_string($conn, $_POST['meta_title']);
    $meta_description = mysqli_real_escape_string($conn, $_POST['meta_description']);
    $meta_keywords = mysqli_real_escape_string($conn, $_POST['meta_keywords']);
    $status = isset($_POST['status']) ? '1' : '0';
    $popular = isset($_POST['popular']) ? '1' : '0';

    $old_image = $_POST['old_image'];
    $new_image = $_FILES['image']['name'];

    if ($new_image != "") {
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = uniqid() . '.' . $image_ext;
    } else {
        $update_filename = $old_image;
    }

    $update_query = "UPDATE categories SET name='$name', slug='$slug', description='$description', meta_title='$meta_title', meta_description='$meta_description', meta_keywords='$meta_keywords', status='$status', popular='$popular', image='$update_filename' WHERE id = '$category_id'";
    $update_query_run = mysqli_query($conn, $update_query);

    $path = "../uploads";
    if ($update_query_run) {
        if ($_FILES['image']['name'] != '') {
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $update_filename);
            if (file_exists($path . '/' . $old_image)) {
                unlink($path . '/' . $old_image);
            }
        }
        redirect("editCategory.php?id=$category_id", "Category updated successfully");
    } else {
        redirect("editCategory.php?id=$category_id", "Something went wrong");
    }
} else if (isset($_POST['delete_category_btn'])) {
    $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);

    $category_query = "SELECT * FROM categories WHERE id = $category_id";
    $category_query_run = mysqli_query($conn, $category_query);
    $category_data = mysqli_fetch_array($category_query_run);
    $category_data_image = $category_data['image'];

    $delete_query = "DELETE FROM categories WHERE id = $category_id";
    $delete_query_run = mysqli_query($conn, $delete_query);

    if ($delete_query_run) {
        // Menghapus image di uploads
        if (file_exists('../uploads/' . $category_data_image)) {
            unlink('../uploads/' . $category_data_image);
        }
        echo 200;
        // redirect('category.php', 'Category deleted successfully');
    } else {
        echo 500;
        // redirect('category.php', 'Something went wrong');
    }
} else if (isset($_POST['add_product_btn'])) {
    $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $slug = mysqli_real_escape_string($conn, $_POST['slug']);
    $small_description = mysqli_real_escape_string($conn, $_POST['small_description']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $original_price = mysqli_real_escape_string($conn, $_POST['original_price']);
    $selling_price = mysqli_real_escape_string($conn, $_POST['selling_price']);
    $qty = mysqli_real_escape_string($conn, $_POST['qty']);
    $meta_title = mysqli_real_escape_string($conn, $_POST['meta_title']);
    $meta_keywords = mysqli_real_escape_string($conn, $_POST['meta_keywords']);
    $meta_description = mysqli_real_escape_string($conn, $_POST['meta_description']);
    $status = isset($_POST['status']) ? '1' : '0';
    $trending = isset($_POST['trending']) ? '1' : '0';

    $image = $_FILES['image']['name'];
    $path = "../uploads";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = uniqid() . '.' . $image_ext;

    if ($name != '' && $slug != '' && $description != '') {
        $product_query = "INSERT INTO products (category_id, name, slug, small_description, description, original_price, selling_price, qty, meta_title, meta_keywords, meta_description, status, trending, image) VALUES ('$category_id', '$name', '$slug', '$small_description', '$description', '$original_price', '$selling_price', '$qty', '$meta_title', '$meta_keywords', '$meta_description', '$status', '$trending', '$filename')";
        $product_query_run = mysqli_query($conn, $product_query);

        if ($product_query_run) {
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $filename);
            redirect('./addProduct.php', 'Product added successfully');
        } else {
            redirect('./addProduct.php', 'Something went wrong');
        }
    } else {
        redirect('./addProduct.php', 'All fields are mandatory');
    }
} else if (isset($_POST['update_product_btn'])) {
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
    $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $slug = mysqli_real_escape_string($conn, $_POST['slug']);
    $small_description = mysqli_real_escape_string($conn, $_POST['small_description']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $original_price = mysqli_real_escape_string($conn, $_POST['original_price']);
    $selling_price = mysqli_real_escape_string($conn, $_POST['selling_price']);
    $qty = mysqli_real_escape_string($conn, $_POST['qty']);
    $meta_title = mysqli_real_escape_string($conn, $_POST['meta_title']);
    $meta_keywords = mysqli_real_escape_string($conn, $_POST['meta_keywords']);
    $meta_description = mysqli_real_escape_string($conn, $_POST['meta_description']);
    $status = isset($_POST['status']) ? '1' : '0';
    $trending = isset($_POST['trending']) ? '1' : '0';

    $old_image = $_POST['old_image'];
    $new_image = $_FILES['image']['name'];

    if ($new_image != "") {
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = uniqid() . '.' . $image_ext;
    } else {
        $update_filename = $old_image;
    }

    $update_product_query = "UPDATE products SET category_id='$category_id', name='$name', slug='$slug', small_description='$small_description', description='$description', original_price='$original_price', selling_price='$selling_price', qty='$qty', meta_title='$meta_title', meta_keywords='$meta_keywords', meta_description='$meta_description', status='$status', trending='$trending', image='$update_filename' WHERE id = '$product_id'";
    $update_product_query_run = mysqli_query($conn, $update_product_query);

    $path = "../uploads";
    if ($update_product_query_run) {
        if ($_FILES['image']['name'] != '') {
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $update_filename);
            if (file_exists($path . '/' . $old_image)) {
                unlink($path . '/' . $old_image);
            }
        }
        redirect("editProduct.php?id=$product_id", "Product updated successfully");
    } else {
        redirect("editProduct.php?id=$product_id", "Something went wrong");
    }
} else if (isset($_POST['delete_product_btn'])) {
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);

    $product_query = "SELECT * FROM products WHERE id = $product_id";
    $product_query_run = mysqli_query($conn, $product_query);
    $product_data = mysqli_fetch_array($product_query_run);
    $product_data_image = $product_data['image'];

    $delete_query = "DELETE FROM products WHERE id = $product_id";
    $delete_query_run = mysqli_query($conn, $delete_query);

    if ($delete_query_run) {
        // Menghapus image di uploads
        if (file_exists('../uploads/' . $product_data_image)) {
            unlink('../uploads/' . $product_data_image);
        }
        echo 200;
        // redirect('products.php', 'Product deleted successfully');
    } else {
        echo 500;
        // redirect('products.php', 'Something went wrong');
    }
} else if (isset($_POST['update_order_btn'])) {
    $tracking_no = $_POST['tracking_no'];
    $order_status = $_POST['order_status'];

    $update_query = "UPDATE orders SET status = '$order_status' WHERE tracking_no = '$tracking_no'";
    $update_query_run = mysqli_query($conn, $update_query);

    redirect("viewOrder.php?target=$tracking_no", "Order updated status successfully");
}
