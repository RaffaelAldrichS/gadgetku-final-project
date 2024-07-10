<?php

include('../middleware/adminMiddleware.php');
include('includes/header.php');

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $category = getById('categories', $id);

                if (mysqli_num_rows($category) > 0) {
                    $data = mysqli_fetch_array($category);
            ?>
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Category
                                <a href="category.php" class="btn btn-primary float-end">Back</a>

                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="./code.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="category_id" value="<?= $data['id'] ?>">
                                <input type="hidden" name="old_image" value="<?= $data['image'] ?>">
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label class="mb-0" for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter category name" value=<?= $data['name'] ?> required>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="mb-0" for="slug">Slug</label>
                                        <input type="text" name="slug" id="slug" class="form-control" placeholder="Enter slug" value=<?= $data['slug'] ?> required>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label class="mb-0" for="description">Description</label>
                                        <textarea name="description" id="description" rows="3" placeholder="Enter description" class="form-control" required><?= $data['description'] ?></textarea>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label class="mb-0" for="image">Upload Image</label>
                                        <input type="file" name="image" id="image" class="form-control mb-2">
                                        <label class="mb-0">Current Image</label>
                                        <img src="../uploads/<?= $data['image'] ?>" alt="<?= $data['name'] ?>" height="50px" width="50px">
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label class="mb-0" for="meta_title">Meta Title</label>
                                        <input type="text" name="meta_title" id="meta_title" class="form-control" placeholder="Enter meta title" value="<?= $data['meta_title'] ?>" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="mb-0" for="meta_description">Meta Description</label>
                                        <textarea name="meta_description" id="meta_description" rows="3" placeholder="Enter meta description" class="form-control" required><?= $data['meta_description'] ?></textarea>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label class="mb-0" for="meta_keywords">Meta Keywords</label>
                                        <textarea name="meta_keywords" id="meta_keywords" rows="3" placeholder="Enter meta keywords" class="form-control" required><?= $data['meta_keywords'] ?></textarea>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="mb-0" for="status">Status</label>
                                        <input type="checkbox" name="status" id="status" <?= $data['status'] == '1' ? 'checked' : '' ?>>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="mb-0" for="popular">Popular</label>
                                        <input type="checkbox" name="popular" id="popular" <?= $data['popular'] == '1' ? 'checked' : '' ?>>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <button class="btn btn-primary" type="submit" name="update_category_btn">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php } else {
                    echo "Category not found";
                } ?>
            <?php } else {
                echo "Id missing from url";
            } ?>
        </div>
    </div>
</div>

<?php include('includes/footer.php') ?>