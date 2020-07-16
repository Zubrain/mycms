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
            $the_post_user = $_GET['author'];
            $the_post_id = $_GET['p_id'];
            }
            ?>
           <h1 class="page-header">
                    THE WORLD OF POSSIBILITIES
                    <br>
                    <small>Making your goals possible...</small>
                </h1>
        <?php
            $query = "SELECT * FROM posts WHERE post_user = '{$the_post_user}' ";
            $select_all_posts_query = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_user = $row['post_user'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = substr($row['post_content'], 0,350);
                 ?>
                 <!-- First Blog Post -->
                <h2>
                <a href="/cms/post/<?php echo $post_id; ?>"><?php echo $post_title?></a>
                </h2>
                <p class="lead">
                    by <a href="/cms/author_posts.php?author=<?php echo $post_user;?>&p_id=<?php echo $post_id?>"><?php echo $post_user;?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo "Posted on ".$post_date?></p>
                <hr>
                <img class="img-responsive" src="/cms/images/<?php echo $post_image;?>" alt="" width="800" height="150">
                <hr>
                <p><?php echo nl2br($post_content)?>...</p>
                <a class="btn btn-primary" href="/cms/post/<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
          <?php  } ?>


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
          $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $the_post_id";
          $update_comment_count = mysqli_query($connection,$query);
        }else{
            echo "<script>alert('Field must not be Empty')</script>";
        }
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