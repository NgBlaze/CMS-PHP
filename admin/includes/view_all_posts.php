<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>Id</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM posts";
            $post_results = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($post_results)) {
                $post_id = $row["post_id"];
                $post_author = $row["post_author"];
                $post_title = $row["post_title"];
                $post_category_id = $row["post_category_id"];
                $post_status = $row["post_status"];
                $post_image = $row["post_image"];
                $post_tags = $row["post_tags"];
                $post_date = $row["post_date"];
                // You can fetch the comment count dynamically if needed
                $post_comment_count = 0;
            ?>
                <tr>
                    <td><?php echo $post_id; ?></td>
                    <td><?php echo $post_author; ?></td>
                    <td><?php echo $post_title; ?></td>


                    <?php

                    if (isset($_GET['p_id'])) {
                        $specific_post_id = $_GET['p_id'];


                        $query = "SELECT * FROM categories WHERE cat_id = $p_id";
                        $update_categories = mysqli_query($connection, $query);

                        while ($row = mysqli_fetch_assoc($update_categories)) {
                            $cat_id = $row['cat_id'];
                            $cat_title = $row['cat_title'];
                        }
                        echo "<td> $cat_title</td>";
                    }


                    ?>








                    <td><?php echo $post_status; ?></td>
                    <td><img width="100px" height="30px" src="../images/<?php echo $post_image; ?>" alt="Post Image"></td>
                    <td><?php echo $post_tags; ?></td>
                    <td><?php echo $post_comment_count; ?></td>
                    <td><?php echo $post_date; ?></td>
                    <?php echo "<td><a href='posts.php?source=update_post&p_id= {$post_id}'>Update</a></td>"; ?>
                    <?php echo "<td><a href='posts.php?delete= {$post_id}'>Delete</a></td>"; ?>

                </tr>
            <?php } ?>
        </tbody>
    </table>

    <?php

    if (isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];

        $query = "DELETE FROM posts WHERE post_id = {$delete_id}";

        $delete_query = mysqli_query($connection, $query);
        header("Location: posts.php");
    }

    ?>


</div>