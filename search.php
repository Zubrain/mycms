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

            if(isset($_POST['submit'])){
                $search = $_POST['search'];
            
                $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ORDER BY post_id DESC ";
                $search_query = mysqli_query($connection, $query);
                if(!$search_query){
                    die ("Query Failed".mysqli_error($connection));
                }
            
                $count = mysqli_num_rows($search_query);
                if($count == 0){
                    echo "<h1>NO RESULT</h1>";
                }else{
            while ($row = mysqli_fetch_assoc($search_query)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_user = $row['post_user'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = substr($row['post_content'], 0,350);
                ?>
                <!-- First Blog Post -->
               <h2>
                   <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title?></a>
               </h2>
               <p class="lead">
                   by <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_user?></a>
               </p>
               <p><span class="glyphicon glyphicon-time"></span> <?php echo "Posted on ".$post_date?></p>
               <hr>
               <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="" width="800" height="180">
               <hr>
               <p><?php echo nl2br($post_content)?>...</p>
               <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

               <hr>
          <?php  } 
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