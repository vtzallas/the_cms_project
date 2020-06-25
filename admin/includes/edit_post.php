<?php 
//WHEN CLICKING  BUTTON EDIT GET THE POST
if(isset($_GET['p_id'])){  
    $the_post_id = $_GET['p_id'];
    $query = "SELECT * FROM posts WHERE post_id = {$the_post_id} ";
    $select_posts_by_id = mysqli_query($connection, $query);

        while ( $row = mysqli_fetch_assoc($select_posts_by_id) ) {
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_category_id = $row['post_category_id'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_content = $row['post_content'];
            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_date = $row['post_date'];
        }
}
//EDIT UPDATE POSTS
if(isset($_POST['update_post'])){
    
    $post_title = $_POST['title'];
    $post_author = $_POST['author'];
    $post_category_id = $_POST['post_category'];
    global $post_category_id;
    $post_status = $_POST['post_status'];
    
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    
    move_uploaded_file($post_image_temp,"images/$post_image");
    
    if(empty($post_image)){
        $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
        $select_image = mysqli_query($connection,$query);
        while($row = mysqli_fetch_array($select_image) ){
            $post_image = $row['post_image'];
        }
        
    }
    
    $query = "UPDATE posts SET post_title = '{$post_title}', post_category_id = '{$post_category_id}', post_date = '{$post_date}', post_author = '{$post_author}', post_status = '{$post_status}', post_tags = '{$post_tags}', post_content = '{$post_content}', post_image = '{$post_image}' WHERE post_id = '{$the_post_id}'";
    
    $update_post_query = mysqli_query($connection , $query);
    confirmQuery($update_post_query);
    
}

?>


<form action='' method='post' enctype='multipart/form-data'>

    <div class='form-group'>
        <label for='title'>Post Title</label>
        <input value="<?php echo $post_title ; ?>" type='text' class='form-control' name='title'>
    </div>

    <div class='form-group'>
        <label for='author'>Author</label>
        <input value="<?php echo $post_author ; ?>" type='text' class='form-control' name='author'>
    </div>
    <div class='form-group'>
        <label for="#post_category">Post Category</label>
        <select class="form-control" name="post_category" id="post_category">
            <?php 
        $query = "SELECT * FROM categories " ;
        $select_categories = mysqli_query( $connection, $query ); 
       
        confirmQuery($select_categories);
            
        while ( $row = mysqli_fetch_assoc( $select_categories ) ) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
//            
            echo"<option value={$cat_id} ( $post_category_id = $cat_id ? 'selected = selected : '') > {$cat_title} </option>";
            echo $post_category_id ;
        }
  ?>

        </select>
    </div>

    <div class='form-group'>
        <label for='status'>Status</label>
        <input value="<?php echo $post_status ; ?>" type='text' class='form-control' name='post_status'>
    </div>

    <div class='form-group'>
        <label for='image'>Image</label>
        <img width="100" src="images/<?php echo $post_image;?>" alt="">
        <input type='file' name='image'>
    </div>

    <div class='form-group'>
        <label for='post_tags'>Tags</label>
        <input value="<?php echo $post_tags ; ?>" type='text' class='form-control' name='post_tags'>
    </div>

    <div class='form-group'>
        <label for='post_content'>Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10"><?php echo"$post_content"; ?>
        </textarea>
    </div>

    <div class='form-group'>
        <label for='date'>Date</label>
        <input value="<?php echo "$post_date" ?>" type='date' class='form-control' name='date'>
    </div>
    <button type='submit' class='btn btn-primary' name='update_post'> Update Post</button>
</form>