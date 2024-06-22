<?php
// Assuming you have established your database connection already

if (isset($_GET['p_id'])) {
    $specific_post_id = $_GET['p_id'];

    $query = "SELECT * FROM posts WHERE post_id = {$specific_post_id}";
    $select_post_by_id = mysqli_query($connection, $query);

    if (!$select_post_by_id) {
        die("Query Failed: " . mysqli_error($connection));
    }

    while ($row = mysqli_fetch_assoc($select_post_by_id)) {
        $post_id = $row["post_id"];
        $post_author = $row["post_author"];
        $post_title = $row["post_title"];
        $post_category_id = $row["post_category_id"];
        $post_status = $row["post_status"];
        $post_image = $row["post_image"];
        $post_tags = $row["post_tags"];
        $post_content = $row["post_content"];
        $post_date = $row["post_date"];
        // You can fetch the comment count dynamically if needed
        $post_comment_count = 0;
    }
}

if (isset($_POST['update_post'])) {

    $post_title = $_POST['title'];
    $post_author = $_POST['author'];
    $post_category_id = $_POST['post_category_id'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];

    // Check if image file was uploaded successfully
    if (!empty($post_image) && !empty($post_image_temp)) {
        $upload_dir = "../images/";

        // Ensure the upload directory exists
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Move the uploaded file to the destination directory
        if (move_uploaded_file($post_image_temp, $upload_dir . $post_image)) {
            echo "File uploaded successfully.";
        } else {
            echo "Error moving the uploaded file.";
        }
    } else {
        // If no new image was uploaded, retain the existing image
        $query = "SELECT post_image FROM posts WHERE post_id = $post_id";
        $select_image_result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($select_image_result);
        $post_image = $row['post_image'];
    }

    // Update query
    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_author = '{$post_author}', ";
    $query .= "post_category_id = '{$post_category_id}', ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_image = '{$post_image}', ";
    $query .= "post_tags = '{$post_tags}', ";
    $query .= "post_date = now(), ";
    $query .= "post_content = '{$post_content}' ";
    $query .= "WHERE post_id = {$specific_post_id}";

    $update_post_result = mysqli_query($connection, $query);

    if (!$update_post_result) {
        die("Query failed: " . mysqli_error($connection));
    } else {
        echo "Post updated successfully.";
    }
}


?>



<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title" value="<?php echo $post_title ?>">
    </div>

    <div class="form-group">
        <?php
        if (isset($_GET['p_id'])) {
            $query = "SELECT * FROM categories";
            $category_query_result = mysqli_query($connection, $query);

            if ($category_query_result) {
        ?>
                <label for="categories">Categories</label>
                <select name="post_category" id="">
                    <?php
                    while ($row = mysqli_fetch_assoc($category_query_result)) {
                        $category_id = $row['cat_id']; // Assuming there is a cat_id field
                        $category = $row['cat_title'];
                        echo "<option value='{$category_id}'>{$category}</option>";
                    }
                    ?>
                </select>
        <?php
            } else {
                echo "Failed to retrieve categories.";
            }
        }
        ?>
    </div>




    <div class="form-group">
        <label for="post_category_id">Post Category Id</label>
        <input type="text" class="form-control" name="post_category_id" value="<?php echo $post_category_id; ?>">
    </div>

    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" class="form-control" name="author" value="<?php echo $post_author ?>">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="post_status" value="<?php echo $post_status ?>">
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" class="form-control" name="image">
        <?php if ($post_image) : ?>
            <img width="100px" height="30px" src="../images/<?php echo $post_image; ?>" alt="Current Image">
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags; ?>">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10"><?php echo $post_content; ?></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
    </div>
</form>