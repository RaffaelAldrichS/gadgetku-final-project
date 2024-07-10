<?php

$currentPage = 'addProduct';
include('../middleware/adminMiddleware.php');
include('includes/header.php');

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Product</h4>
                </div>
                <div class="card-body">
                    <form action="./code.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label class="mb-0" for="category_id">Select Category</label>
                                <select class="form-select" id="category_id" name="category_id" required>
                                    <option selected>Select Category</option>
                                    <?php
                                    $categories = getAll('categories');
                                    if (mysqli_num_rows($categories) > 0) {
                                        foreach ($categories as $item) {
                                    ?>
                                            <option value=<?= $item['id'] ?>><?= $item['name'] ?></option>
                                    <?php
                                        }
                                    } else {
                                        echo "No category available";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="mb-0" for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter product name" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="mb-0" for="slug">Slug</label>
                                <input type="text" name="slug" id="slug" class="form-control" placeholder="Enter slug" required>
                            </div>
                            <div class="col-md-12 mb-2">
                                <label class="mb-0" for="small_description">Small Description</label>
                                <textarea name="small_description" id="small_description" rows="3" placeholder="Enter small description" class="form-control" required></textarea>
                            </div>
                            <div class="col-md-12 mb-2">
                                <label class="mb-0" for="description">Description</label>
                                <textarea name="description" id="description" rows="3" placeholder="Enter description" class="form-control" required></textarea>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="mb-0" for="original_price">Original Price</label>
                                <input type="text" name="original_price" id="original_price" class="form-control" placeholder="Enter original price" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="mb-0" for="selling_price">Selling Price</label>
                                <input type="text" name="selling_price" id="selling_price" class="form-control" placeholder="Enter selling price" required>
                            </div>
                            <div class="col-md-12 mb-2">
                                <label class="mb-0" for="image">Upload Image</label>
                                <input type="file" name="image" id="image" class="form-control" required>
                            </div>
                            <div class="d-flex align-items-end row">
                                <div class="col-md-6 mb-2">
                                    <label class="mb-0" for="qty">Quantity</label>
                                    <input type="text" name="qty" id="qty" class="form-control" placeholder="Enter quantity" required>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label class="mb-0" for="status">Status</label>
                                    <input type="checkbox" name="status" id="status">
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label class="mb-0" for="trending">Trending</label>
                                    <input type="checkbox" name="trending" id="trending">
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <label class="mb-0" for="meta_title">Meta Title</label>
                                <input type="text" name="meta_title" id="meta_title" class="form-control" placeholder="Enter meta title" required>
                            </div>
                            <div class="col-md-12 mb-2">
                                <label class="mb-0" for="meta_description">Meta Description</label>
                                <textarea name="meta_description" id="meta_description" rows="3" placeholder="Enter meta description" class="form-control" required></textarea>
                            </div>
                            <div class="col-md-12 mb-2">
                                <label class="mb-0" for="meta_keywords">Meta Keywords</label>
                                <textarea name="meta_keywords" id="meta_keywords" rows="3" placeholder="Enter meta keywords" class="form-control" required></textarea>
                            </div>
                            <div class="col-md-12 mb-2">
                                <button class="btn btn-primary" type="submit" name="add_product_btn">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php') ?>