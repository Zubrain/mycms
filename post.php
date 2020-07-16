<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<?php include "admin/functions.php"; ?>
   <!-- Navigation -->
    <?php include "includes/navigation.php"?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
            <?php
            if(isset($_GET['p_id'])){
            $the_post_id = $_GET['p_id'];

            $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = {$the_post_id}  ";
            $send_query = mysqli_query($connection,$view_query);
            ?>
            <?php
            if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
                $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
            } else {
                $query = "SELECT * FROM posts WHERE post_id = $the_post_id AND post_status = 'published' ";
            }
            ?>
            <h1 class="page-header">
            THE WORLD OF POSSIBILITIES
                    <br>
                    <small>Changing Lives...</small>
                </h1>
        <?php
            $select_all_posts_query = mysqli_query($connection, $query);
            if(mysqli_num_rows( $select_all_posts_query) < 1){
                echo "<h1 class='text-center' style='color: #337ab7;'>No Post Available</h1>";
            }else{
            while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_user = $row['post_user'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
                 ?>
                 <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title?></a>
                </h2>
                <p class="lead">
                by <a href="/cms/author_posts.php?author=<?php echo $post_user;?>&p_id=<?php echo $post_id?>"><?php echo $post_user;?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo "Posted on ".$post_date?></p>
                <hr>
                <img class="img-responsive" src="/cms//images/<?php echo $post_image;?>" alt="" width="800" height="150">
                <hr>
                <p><?php echo nl2br($post_content)?></p>

                <hr>
          <?php  }?>


           <!-- Blog Comments -->

           <?php
           if(isset($_POST['create_comment'])){
            $the_post_id = $_GET['p_id'];
            $comment_author = $_POST['comment_author'];
            $comment_email = $_POST['comment_email'];
            $comment_content = $_POST['comment_content'];
            if (! empty($comment_author) && ! empty($comment_email) && ! empty($comment_content)) {
            $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)";
            $query.= "VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";

            $create_comment_query = mysqli_query($connection, $query);

            confirmQuery($create_comment_query);
                
        //   $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $the_post_id";
        //   $update_comment_count = mysqli_query($connection,$query);
        }else{
            echo "<script>alert('Field must not be Empty')</script>";
        }
    }
?>

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="post">
                        <div class="form-group">
                        <label for="Author">Author</label>
                            <input type="text" class="form-control" name="comment_author">
                        </div>
                        <div class="form-group">
                        <label for="email">Email</label>
                            <input type="email" class="form-control" name="comment_email">
                        </div>
                        <div class="form-group">
                        <label for="commentarea">Your Comment</label>
                            <textarea name="comment_content" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php
                $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} ";
                $query.= "AND comment_status = 'approved' ";
                $query.= "ORDER BY  comment_id DESC" ;
                $select_comment_query = mysqli_query($connection, $query);
                confirmQuery($select_comment_query);
                while ($row = mysqli_fetch_array($select_comment_query)) {
                    $comment_date = $row['comment_date'];
                    $comment_content = $row['comment_content'];
                    $comment_author = $row['comment_author'];
                    ?>
                    <!-- Comment -->
                    <div class="media">
                        <!-- <a class="pull-left" href="#">
                            <img class="media-object" src="/cms/images/images1.jpg" alt="">
                        </a> -->
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo $comment_author;?>
                                <small><?php echo $comment_date;?></small>
                            </h4>
                            <?php echo $comment_content;?>
                        </div>
                    </div>
                    <?php } 
                       } }else {
                        header("Location:index.php");
                    }
                    ?>

               
            </div>
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>
        </div>
        <!-- /.row -->
        <hr>
        <!-- Footer -->
        <?php include "includes/footer.php"; ?>