<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
   <!-- Navigation -->
    <?php include "includes/navigation.php"?>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8">
            <h1 class="page-header">
                    THE WORLD OF POSSIBILITIES
                    <br>
                    <small>Making your goals possible...</small>
                </h1>
        <?php
            if(isset($_GET['category'])){
                $category_post_id = $_GET['category'];
                if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {

                    $stmt1 = mysqli_prepare($connection, "SELECT post_id, post_title, post_user, post_date, post_image, post_content, post_status FROM posts WHERE post_category_id = ?");
                } else {
                    $stmt2 = mysqli_prepare($connection, "SELECT post_id, post_title, post_user, post_date, post_image, post_content, post_status FROM posts WHERE post_category_id = ? AND post_status = ?");
                $published = 'published';
                }
                if(isset($stmt1)){
                    mysqli_stmt_bind_param($stmt1, "i", $category_post_id);
                    mysqli_stmt_execute($stmt1);
                    mysqli_stmt_bind_result($stmt1, $post_id, $post_title, $post_user, $post_date, $post_image, $post_content, $post_status);
                    $stmt = $stmt1;
                }else{
                    mysqli_stmt_bind_param($stmt2, "is", $category_post_id, $published);
                    mysqli_stmt_execute($stmt2);
                    mysqli_stmt_bind_result($stmt2, $post_id, $post_title, $post_user, $post_date, $post_image, $post_content, $post_status);
                    $stmt = $stmt2;
                }

            // if(mysqli_stmt_num_rows($stmt) > 1){
            //     echo "<h1 class='text-center' style='color: #337ab7;'>No Post Available in this Category</h1>";
            // }
                while(mysqli_stmt_fetch($stmt)){
                    $post_content = substr($post_content, 0,350);
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
                <a href="/cms/post/<?php echo $post_id; ?>">
                <img class="img-responsive" src="/cms/images/<?php echo $post_image;?>" alt="" width="800" height="150">
                </a>
                <hr>
                <p><?php echo nl2br($post_content)?>...</p>
                <a class="btn btn-primary" href="/cms/post/<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
          <?php   } mysqli_stmt_close($stmt); }else {
              header("Location: index.php");
          }?>
            </div>
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>
        </div>
        <!-- /.row -->
        <hr>
        <!-- Footer -->
        <?php include "includes/footer.php"; ?>