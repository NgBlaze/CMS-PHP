<?php
include("../includes/db.php");


function insertCategory()
{
    global $connection;
    if (isset($_POST['submit'])) {

        $cat_title = $_POST['cat_title'];

        if ($cat_title == '' || empty($cat_title)) {
            echo "This field is required";
        } else {
            $query = "INSERT INTO categories (cat_title) VALUES ('$cat_title')";
            $create_category_query = mysqli_query($connection, $query);

            if (!$create_category_query) {
                die("Could not create category" . mysqli_error($connection));
            }
        }
    }
}


function updateForm()
{
    global $connection;
    if (isset($_POST['update'])) {
        $cat_title = $_POST['cat_title'];
        $cat_id = $_POST['cat_id'];

        if ($cat_title == '' || empty($cat_title)) {
            echo "This field is required";
        } else {
            $query = "UPDATE categories SET cat_title = '$cat_title' WHERE cat_id = $cat_id";
            $update_category_query = mysqli_query($connection, $query);

            if (!$update_category_query) {
                die("Could not update category" . mysqli_error($connection));
            } else {
                header("Location: categories.php");
            }
        }
    }
}

function updateCategory()
{
    global $connection;
    if (isset($_GET['update'])) {
        $update_id = $_GET['update'];

        $query = "SELECT * FROM categories WHERE cat_id = $update_id";
        $update_categories = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($update_categories)) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
?>

            <form action="" method="post">
                <div class="form-group">
                    <label for="cat_title">Update Category</label>
                    <input value="<?php echo $cat_title; ?>" type="text" name="cat_title" class="form-control">
                    <input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>">
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" name="update" value="Update Category">
                </div>
            </form>

<?php }
    }
}

function readCategories()
{
    global $connection;
    $query = 'SELECT * FROM categories';
    $select_categories = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_categories)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>";
        echo " <td>{$cat_id}</td>";
        echo " <td>{$cat_title}</td>";
        echo " <td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo " <td><a href='categories.php?update={$cat_id}'>Update</a></td>";
        echo " </tr>";
    }
}

function deleteCategory()
{
    global $connection;
    if (isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];

        $query = "DELETE FROM categories WHERE cat_id = {$delete_id}";
        $delete_category_query = mysqli_query($connection, $query);
        header("Location: categories.php");
    }
}
