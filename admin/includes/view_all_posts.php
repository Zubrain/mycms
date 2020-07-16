<?php
include "delete_modal.php";
?>
<?php
// if(isset($_POST['checkBoxArray'])){
//     foreach($_POST['checkBoxArray'] as $postValueId){
//      $bulk_options = $_POST['bulk_options'];
//      switch ($bulk_options) {
//          case 'published':
//          $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";
//          $update_to_published_status = mysqli_query($connection, $query);
//          confirmQuery($update_to_published_status);
//              break;
//          case 'draft':
//          $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";
//          $update_to_draft_status = mysqli_query($connection, $query);
//          confirmQuery($update_to_draft_status);
//             break;
//          case 'delete':
//          $query = "DELETE FROM posts WHERE post_id = {$postValueId} ";
//          $update_to_delete_status = mysqli_query($connection, $query);
//          confirmQuery($update_to_delete_status);
//             break;
//          case 'clone':
//          $query = "SELECT * FROM posts WHERE post_id = {$postValueId} ";
//          $select_posts_query = mysqli_query($connection, $query);
//          while ($row = mysqli_fetch_assoc($select_posts_query)) {
//             $post_id = $row['post_id'];
//             $post_user = $row['post_user'];
//             $post_title = $row['post_title'];
//             $post_category_id = $row['post_category_id'];
//             $post_status = $row['post_status'];
//             $post_image = $row['post_image'];
//             $post_tags = $row['post_tags'];
//             $post_comment_count = $row['post_comment_count'];
//             $post_date = $row['post_date'];
//             $post_content = $row['post_content'];

//             $query = "INSERT into posts(post_category_id,post_title,post_user,post_date,post_image,post_content,post_tags,post_status) ";
//             $query.= "VALUES( {$post_category_id},'{$post_title}','{$post_user}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}' ) ";
            
//             $update_to_clone_status = mysqli_query($connection, $query);
//          confirmQuery($update_to_clone_status);
//             break;

        //  default:
        
        //      break;
//      }
//     }
// }
// }
?>
<form action="" method="post">
<table class="table table-bordered table-hover table-responsive">


<div class="col-xs-4">
<a class="btn btn-primary" href="posts.php?source=add_post">Add New Post</a>
</div>
                         <thead>
                             <tr>
                                 <th><input id="selectAllBoxes" type="checkbox"></th>
                                 <th>Id</th>
                                 <th>User</th>
                                 <th>Title</th>
                                 <th>Category</th>
                                 <th>Status</th>
                                 <th>Image</th>
                                 <th>Tags</th>
                                 <th>Comments</th>
                                 <th>Date</th>
                                 <th>View Post</th>
                                 <th>Edit</th>
                                 <th>Delete</th>
                                 <th>Post View</th>
                             </tr>
                         </thead>
                         <tbody>
                         <?php
                         $query = "SELECT * FROM posts ORDER BY post_id DESC ";
                                $select_posts = mysqli_query($connection, $query);
                                ?>
                                <?php
                                while ($row = mysqli_fetch_assoc($select_posts)) {
                                    $post_id = $row['post_id'];
                                    $post_user = $row['post_user'];
                                    $post_title = $row['post_title'];
                                    $post_category_id = $row['post_category_id'];
                                    $post_status = $row['post_status'];
                                    $post_image = $row['post_image'];
                                    $post_tags = $row['post_tags'];
                                    $post_comment_count = $row['post_comment_count'];
                                    $post_date = $row['post_date'];
                                    $post_views_count = $row['post_views_count'];
                                echo "<tr>";
                                ?>
                                <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>
                                <?php
                                echo "<td>{$post_id}</td>";
                                if(!empty($post_author)){
                                    echo "<td>{$post_author}</td>";
                                }elseif (!empty($post_user)) {
                                     echo "<td>{$post_user}</td>";
                                }
                                // if (strlen($post_title)>30){$post_title= substr($post_title,0,35);}
                                echo "<td>{$post_title}</td>";

                                $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
                                $select_categories_id = mysqli_query($connection, $query);
                               
                                while ($row = mysqli_fetch_assoc($select_categories_id)) {
                                    $cat_id = $row['cat_id'];
                                    $cat_title = $row['cat_title'];
                                }
                                echo "<td>{$cat_title}</td>";
                                echo "<td>{$post_status}</td>";
                                echo "<td><img class='img-responsive' src='../images/$post_image' width='100'></td>";
                                if (strlen($post_tags)>8){$post_tags= substr($post_tags,0,7);}
                                echo "<td>{$post_tags}</td>";

                                $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
                                $send_comment_query = mysqli_query($connection,$query);
                                $row = mysqli_fetch_array($send_comment_query);
                                $comment_id = $row['comment_id'];
                                $count_comments = mysqli_num_rows($send_comment_query);

                                echo "<td><a href='post_comments.php?id=$post_id'>{$count_comments}</a></td>";


                                echo "<td>{$post_date}</td>";
                                echo "<td><a class='btn btn-primary' href='../post.php?p_id={$post_id}'>View Post</a></td>";
                                echo "<td><a class='btn btn-warning' href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
            ?>
                    <form action="" method="post">
                    <input type="hidden" name="post_id" value="<?php echo $post_id ?>">
                    <?php
                    echo "<td><input class='btn btn-danger' type='submit' name='delete' value='Delete'></td>";
                    ?>
                    </form>
            <?php
                                // echo "<td><a rel='$post_id' href='javascript:void(0)' class='delete_link'>Delete</a></td>";
                               
                                echo "<td>{$post_views_count}<br/><a class='btn btn-info btn-xs' href='posts.php?reset={$post_id}'>Reset Count</a></td>";
                                echo "</tr>";
                                }
                                ?>
                         </tbody>
                     </table>
                     </form>
                     <?php
                        if(isset($_POST['post_id'])){
                            $the_post_id = escape($_POST['post_id']);

                        $query = "DELETE FROM posts WHERE post_id = {$the_post_id} ";
                        $delete_post = mysqli_query($connection,$query);
                        header("Location: posts.php");
                        confirmQuery($delete_post);
                        }
                     ?>
                     <?php
                        if(isset($_GET['reset'])){
                            $the_reset_id = $_GET['reset'];
                            $post_reset_value = 0 ;
                        $query = " UPDATE posts SET post_views_count = '{$post_reset_value}' WHERE post_id =". mysqli_real_escape_string($connection, $_GET['reset'])." ";
                        $reset_post = mysqli_query($connection,$query);
                        header("Location: posts.php");
                        confirmQuery($reset_post);
                        }
                     ?>
                     <script>
                        $(document).ready(function(){
                            $(".delete_link").on('click', function(){
                                var id = $(this).attr("rel");
                                var delete_url = "posts.php?delete="+ id +" ";
                              $(".modal_delete_link").attr("href", delete_url );
                              $("#myModal").modal('show');
                            });
                        }); 
                     </script>
