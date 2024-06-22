<?php
include("includes/admin_header.php");
include("functions.php");
?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include("includes/admin_navigation.php") ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>Author</small>
                        </h1>

                        <div class="col-xs-6">

                            <?php

                            // Insert Categories
                            insertCategory();


                            // Handle update form submission
                            updateForm();
                            ?>

                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat_title">Category Name</label>
                                    <input type="text" name="cat_title" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                </div>
                            </form>

                            <?php
                            //Update Category
                            updateCategory();

                            ?>

                        </div>
                        <!-- Add Category form -->

                        <div class="col-xs-6">

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //Read Categories

                                    readCategories();
                                    ?>

                                    <?php
                                    //Delete Categories
                                    deleteCategory();

                                    ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include("includes/admin_footer.php") ?>

</body>

</html>