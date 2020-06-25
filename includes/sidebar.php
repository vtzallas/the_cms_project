<?php include_once"db.php";?>
<link href="css/home.css" rel="stylesheet">
<div class="col-md-4">


    <!-- Blog Search Well -->
    <div class="well">

        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button name="submit" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>




    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <?php 
        $query = "SELECT * FROM categories" ;
        $categories_query = mysqli_query($connection , $query);
         ?>
                <ul class=" list-unstyled list-sidebar">
                    <?php 
        while($row = mysqli_fetch_assoc($categories_query)) {
            $cat_title = $row['cat_title'];
             $cat_id = $row['cat_id'];
                  ?>
                    <li><a href="category.php?category=<?php echo $cat_id ?>"><?php echo $cat_title ?></a> </li>
                    <?php } ?>
                </ul>
            </div>
            <!-- /.col-lg-6 -->
            <!--
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>
-->
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <div class="well">
        <h4>Side Widget Well</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
    </div>

</div>