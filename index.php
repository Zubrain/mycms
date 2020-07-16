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

                if(isset($_GET['page'])){
                    $page = $_GET['page'];
                }else{
                    $page = "";
                }
                if($page == "" || $page == 1){
                    $page_1 = 0;
                }else {
                    $page_1 = ($page * 5) - 5;
                }
                 
                if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
                    $postquery = "SELECT * FROM posts";
                } else {
                    $postquery = "SELECT * FROM posts WHERE post_status = 'published' ";
                }
                
            
            $find_count = mysqli_query($connection, $postquery);
            $count = mysqli_num_rows($find_count);
            if($count < 1) {
                echo "<h1 class='text-center' style='color: #337ab7;'>No Post Available</h1>";
            } else{
            $count = ceil($count / 5);
            ?>
        <?php
        if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
            $query = "SELECT * FROM posts ORDER BY post_id DESC LIMIT $page_1,5 ";
        } else {
            $query = "SELECT * FROM posts WHERE post_status = 'published' ORDER BY post_id DESC LIMIT $page_1,5 ";
        }
        
            
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
                    <a href="post/<?php echo $post_id; ?>"><?php echo $post_title?></a>
                </h2>
                <p class="lead">
                by <a href="author_posts.php?author=<?php echo $post_user;?>&p_id=<?php echo $post_id?>"><?php echo $post_user;?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo "Posted on ".$post_date?></p>
                <hr>
                <a href="post/<?php echo $post_id; ?>">
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="" width="800" height="150">
                </a>
                <hr>
                <p><?php echo nl2br($post_content)?>...</p>
                <a class="btn btn-primary" href="post/<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
          <?php  } }?>
            </div>
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>
        </div>
        <!-- /.row -->
        <hr>
                <ul class="pager">
                    <?php
                    for ($i=1; $i <= $count ; $i++) { 
                        if ($i == $page) {
                          echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
                        }else{
                          echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
                        }
                    }
                    ?>
                </ul>
        <!-- Footer -->
        <?php include "includes/footer.php"; ?>