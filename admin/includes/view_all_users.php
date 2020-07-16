<table class="table table-bordered table-hover table-responsive">
                         <thead>
                             <tr>
                                 <th>Id</th>
                                 <th>Username</th>
                                 <th>Firstname</th>
                                 <th>Lastname</th>
                                 <th>Email</th>
                                 <th>Role</th>
                         </thead>
                         <tbody>
                         <?php
                         $query = "SELECT * FROM users";
                                $select_users = mysqli_query($connection, $query);
                                ?>
                                <?php
                                while ($row = mysqli_fetch_assoc($select_users)) {
                                    $user_id = $row['user_id'];
                                    $username = $row['username'];
                                    $user_password = $row['user_password']; 
                                    $user_firstname = $row['user_firstname'];
                                    $user_lastname = $row['user_lastname'];
                                    $user_email = $row['user_email'];
                                    $user_image = $row['user_image'];
                                    $user_role = $row['user_role'];

                                echo "<tr>";
                                echo "<td>{$user_id}</td>";
                                echo "<td>{$username}</td>";
                                echo "<td>{$user_firstname}</td>";


                              /*   $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
                                $select_categories_id = mysqli_query($connection, $query);
                               
                                while ($row = mysqli_fetch_assoc($select_categories_id)) {
                                    $cat_id = $row['cat_id'];
                                    $cat_title = $row['cat_title'];
                                     echo "<td>{$cat_title}</td>";
                                } */
                               
                                echo "<td>{$user_lastname}</td>";
                                echo "<td>{$user_email}</td>";

                              /*   $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
                                $select_post_id_query = mysqli_query($connection, $query);
                                while ($row = mysqli_fetch_assoc($select_post_id_query)){
                                    $post_id = $row['post_id'];
                                    $post_title = $row['post_title'];

                                    echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                                } */
                                
                                echo "<td>{$user_role}</td>";
                                echo "<td><a class='btn btn-success' href='users.php?change_to_admin={$user_id}'>Admin</a></td>";
                                echo "<td><a class='btn btn-warning' href='users.php?change_to_subscriber={$user_id}'>Subscriber</a></td>";
                                echo "<td><a class='btn btn-primary' href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
                                ?>
                    <form action="" method="post">
                    <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
                    <?php
                    echo "<td><input class='btn btn-danger' type='submit' name='delete' value='Delete'></td>";
                    ?>
                    </form>
            <?php
                                echo "</tr>";
                                }
                                ?>
                         </tbody>
                     </table>
                     <?php
                        if(isset($_GET['change_to_admin'])){
                            $the_user_id = $_GET['change_to_admin'];

                        $query = "UPDATE users SET user_role = 'admin' WHERE user_id = {$the_user_id} ";
                        $make_admin_query = mysqli_query($connection,$query);
                        header("Location: users.php");
                        confirmQuery($make_admin_query);
                        }
                        if(isset($_GET['change_to_subscriber'])){
                            $the_user_id = $_GET['change_to_subscriber'];

                       
                        $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = {$the_user_id} ";
                        $make_subscriber_query = mysqli_query($connection,$query);
                        header("Location: users.php");
                        confirmQuery($make_subscriber_query);
                        }
                        
                        if(isset($_POST['user_id'])){
                            if(isset($_SESSION['user_role'])){
                                if($_SESSION['user_role'] == 'admin'){
                                    $the_user_id = mysqli_real_escape_string($connection, $_POST['user_id']);

                        $query = "DELETE FROM users WHERE user_id = {$the_user_id} ";
                        $delete_user_query = mysqli_query($connection,$query);
                        header("Location: users.php");
                        confirmQuery($delete_user_query);
                                    }
                                }
                            }
                            
                     ?>