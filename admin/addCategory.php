<?php

$currentPage = 'addCategory';
include('../middleware/adminMiddleware.php');
include('includes/header.php');

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Category</h4>
                </div>
                <div class="card-body">
                    <form action="./code.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label class="mb-0" for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter category name" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="mb-0" for="slug">Slug</label>
                                <input type="text" name="slug" id="slug" class="form-control" placeholder="Enter slug" required>
                            </div>
                            <div class="col-md-12 mb-2">
                                <label class="mb-0" for="description">Description</label>
                                <textarea name="description" id="description" rows="3" placeholder="Enter description" class="form-control" required></textarea>
                            </div>
                            <div class="col-md-12 mb-2">
                                <label class="mb-0" for="image">Upload Image</label>
                                <input type="file" name="image" id="image" class="form-control" required>
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
                            <div class="col-md-6 mb-2">
                                <label class="mb-0" for="status">Status</label>
                                <input type="checkbox" name="status" id="status">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="mb-0" for="popular">Popular</label>
                                <input type="checkbox" name="popular" id="popular">
                            </div>
                            <div class="col-md-12 mb-2">
                                <button class="btn btn-primary" type="submit" name="add_category_btn">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php') ?>