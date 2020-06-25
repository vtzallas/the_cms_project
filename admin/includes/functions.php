<?php
//RELATE THE POSTS WITH POST_CATEGORY_id
function relate_post_category_id($post_categories_id){
global $connection;
$query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} ";
                                 $result_categories_id = mysqli_query($connection, $query);

                            while ($row = mysqli_fetch_assoc($result_categories_id)) {
                                $cat_id = $row['cat_id'];
                                $cat_title = $row['cat_title'];
                                
                                echo "<td>$cat_title </td>" ;
                            }
}


//SHOW ERRORS IN THE QUERIES
function confirmQuery($result){
    global $connection;
    if(!$result){
        die( 'QUERY FAILED '. mysqli_error( $connection ) );
    }
    
}
//INNSERT CATEGORIES
function insert_categories() {
    global $connection ;
    if ( isset( $_POST['submit'] ) ) {
        $cat_title = $_POST['cat_title'];
        $sql_cat_title = "SELECT * from categories WHERE cat_title = '$cat_title'";
        $result_category = mysqli_query( $connection, $sql_cat_title ) or die( mysqli_error( $connection ) );
        if ( mysqli_num_rows( $result_category ) >= 1 ) {
            $cat_title_error = 'Sorry ... Category already exists';
            echo"<h1 style='color: red' > $cat_title_error</h1>";
        } elseif ( ctype_space( $cat_title ) == ' ' || empty( $cat_title ) ) {
            echo"<h1 style='color: red' > This field should not be empty</h1>";
        } else {
            $query = "INSERT INTO categories(cat_title) VALUES('{$cat_title}')";
            $create_category_query = mysqli_query( $connection, $query );
            if ( !$create_category_query ) {
                die( 'QUERY FAILED '. mysqli_error( $connection ) );
            }
        }

    }
    
    // FIND CATEGORIES WITH TABLE
    function findAllCategories () {
        global $connection;
        $query = 'SELECT * FROM categories';
        $select_categories = mysqli_query( $connection, $query );

        while ( $row = mysqli_fetch_assoc( $select_categories ) ) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            echo '<tr>';
            echo "<td>{$cat_id}</td>";
            echo "<td>{$cat_title}</td>";
            echo "<td> <a href ='categories.php?delete={$cat_id}'>Delete </a> 
                                </td>";
            echo "<td> <a href ='categories.php?edit={$cat_id}'>Edit </a> </td>";
            echo '<tr>';
        }

    }
    //DELETE CATEGORIES
    function deleteCategories() {
        global $connection ;
        if ( isset( $_GET['delete'] ) ) {
            $the_cat_id = $_GET['delete'];
            $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
            $delete_query = mysqli_query( $connection, $query );
            header( 'Location: categories.php' );
        }

    }

}
?>