<?php

$currentPage = 'products';
include('../middleware/adminMiddleware.php');
include('includes/header.php');

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $product = getById('products', $id);
                if (mysqli_num_rows($product) > 0) {
                    $data = mysqli_fetch_array($product);
            ?>
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Product
                                <a href="products.php" class="btn btn-primary float-end">Back</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="./code.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="product_id" value="<?= $data['id'] ?>">
                                <input type="hidden" name="old_image" value="<?= $data['image'] ?>">
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
                                                    <option value=<?= $item['id'] ?> <?= $data['category_id'] == $item['id'] ? 'selected' : '' ?>><?= $item['name'] ?></option>
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
                                        <input value="<?= $data['name'] ?>" type="text" name="name" id="name" class="form-control" placeholder="Enter product name" required>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="mb-0" for="slug">Slug</label>
                                        <input value="<?= $data['slug'] ?>" type="text" name="slug" id="slug" class="form-control" placeholder="Enter slug" required>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label class="mb-0" for="small_description">Small Description</label>
                                        <textarea name="small_description" id="small_description" rows="3" placeholder="Enter small description" class="form-control" required><?= $data['small_description'] ?></textarea>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label class="mb-0" for="description">Description</label>
                                        <textarea name="description" id="description" rows="3" placeholder="Enter description" class="form-control" required><?= $data['description'] ?></textarea>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="mb-0" for="original_price">Original Price</label>
                                        <input value="<?= $data['original_price'] ?>" type="text" name="original_price" id="original_price" class="form-control" placeholder="Enter original price" required>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="mb-0" for="selling_price">Selling Price</label>
                                        <input value="<?= $data['selling_price'] ?>" type="text" name="selling_price" id="selling_price" class="form-control" placeholder="Enter selling price" required>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label class="mb-0" for="image">Upload Image</label>
                                        <input type="file" name="image" id="image" class="form-control mb-2">
                                        <label for="">Current image</label>
                                        <img src="../uploads/<?= $data['image'] ?>" alt="<?= $data['name'] ?>" width="50px" height="50px">
                                    </div>
                                    <div class="d-flex align-items-end row">
                                        <div class="col-md-6 mb-2">
                                            <label class="mb-0" for="qty">Quantity</label>
                                            <input value="<?= $data['qty'] ?>" type="text" name="qty" id="qty" class="form-control" placeholder="Enter quantity" required>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label class="mb-0" for="status">Status</label>
                                            <input type="checkbox" name="status" id="status" <?= $data['status'] == '1' ? 'checked' : '' ?>>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label class="mb-0" for="trending">Trending</label>
                                            <input type="checkbox" name="trending" id="trending" <?= $data['trending'] == '1' ? 'checked' : '' ?>>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label class="mb-0" for="meta_title">Meta Title</label>
                                        <input value="<?= $data['meta_title'] ?>" type="text" name="meta_title" id="meta_title" class="form-control" placeholder="Enter meta title" required>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label class="mb-0" for="meta_description">Meta Description</label>
                                        <textarea name="meta_description" id="meta_description" rows="3" placeholder="Enter meta description" class="form-control" required><?= $data['meta_description'] ?></textarea>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label class="mb-0" for="meta_keywords">Meta Keywords</label>
                                        <textarea name="meta_keywords" id="meta_keywords" rows="3" placeholder="Enter meta keywords" class="form-control" required><?= $data['meta_keywords'] ?></textarea>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <button class="btn btn-primary" type="submit" name="update_product_btn">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            <?php } else {
                    echo "Product not found for given id";
                }
            } else {
                echo "Id missing from url";
            }
            ?>
        </div>
    </div>
</div>

<?php include('includes/footer.php') ?>