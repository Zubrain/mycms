<div class="well" style="margin: 0px 0px; padding: 0px 0px;">
    <div class="card" style="margin-top:-20px; border-radius: 50% 0 0 50%;">
        <div class="card-header bg-primary text-white text-center" style="border-radius: 5% 5% 0 0;">
            <h3 style="padding: 5px;">Recent Posts</h3>
        </div>
        <div class="card-body">
        <?php
        global $connection;
                $query = "SELECT * FROM posts WHERE post_status = 'published' ORDER BY post_id DESC LIMIT 0,5" ;
                $select_all_post = mysqli_query($connection, $query);
          while ($row = mysqli_fetch_array($select_all_post)) {
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_user = $row['post_user'];
            $post_date = $row['post_date'];
            $post_image = $row['post_image'];
        ?>
        <div class="row" style="margin-bottom:0px;">
            <div class="col-md-3 col-xs-3 col-xl-3 col-sm-3 col-lg-3" style="margin-left:5px;">
                <div class="media">
            <img class="img-responsive img-fluid align-self-start media-object" src="/cms/images/<?php echo $post_image;?>" alt="" width="70" height="50">
                </div>
            </div>
            <div class="col-md-9 col-xs-9 col-xl-9 col-sm-9 col-lg-9" style="margin-left:-15px;">
                <div class="media-body">
                <a href="post/<?php echo $post_id; ?>" target="_blank"><h6 class="media-heading" style="padding-top:7px;"><?php echo $post_title;?></a>
                            <small><?php echo $post_date;?></small>
                    </h6>
                </div>
            </div>
        </div><hr style="margin:2px;">
        <?php } ?>
        </div>

                    <!-- <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p> -->
              
                </div></div></div>