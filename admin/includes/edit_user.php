<?php
if(isset($_GET['edit_user'])){
    $the_user_id = $_GET['edit_user'];


    $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
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

}
if(isset($_POST['edit_user'])){
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];

   /* $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name']; */

    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    // move_uploaded_file($post_image_temp, "../images/$post_image");   
    if(!empty($user_password)){
        $query_password = "SELECT user_password FROM users WHERE user_id =  $the_user_id";
        $get_user_query = mysqli_query($connection,$query_password);
        confirmQuery($get_user_query);

        $row = mysqli_fetch_array($get_user_query);
            
        $db_user_password = $row['user_password'];
       
        if($db_user_password != $user_password){
        $hash_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
    }else{
        $hash_password = $db_user_password;
    }
         $query = "UPDATE users SET ";
        $query.= "user_firstname = '{$user_firstname}', ";
        $query.= "user_lastname= '{$user_lastname}', ";
        $query.= "user_role= '{$user_role}', ";
        $query.= "username= '{$username}', ";
        $query.= "user_email= '{$user_email}', ";
        $query.= "user_password= '{$hash_password}' ";
        $query.= "WHERE user_id = {$the_user_id} ";

        $update_user = mysqli_query($connection,$query);

        confirmQuery($update_user);
        header("Location: users.php");
    }
    }
}else{
    header("Location: index.php");
}
?>
<div class="col-md-8">
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
    <label for="post-title">Firstname</label>
    <input class="form-control" type="text" name="user_firstname" value="<?php echo $user_firstname ;?>" >
    </div>
    <div class="form-group">
    <label for="author">Lastname</label>
    <input class="form-control" type="text" name="user_lastname" value="<?php echo $user_lastname ;?>" >
    </div>
    <div class="form-group">
    <label for="user-role">User Role</label>
    <select class="form-control" name="user_role" id="user_role" >
    <option value="<?php echo $user_role;?>"><?php echo $user_role;?></option>
    <?php
     if($user_role == 'admin'){
         echo "<option value='subscriber'>subscriber</option>";
     }else{
         echo "<option value='admin'>admin</option>";
     }

          ?>
          </select>        
    </div>
    <div class="form-group">
    <label for="username">Username</label>
    <input class="form-control" type="text" name="username"  value="<?php echo $username ;?>">
    </div>
    <!-- <div class="form-group">
    <label for="post-image">Post Image</label>
    <input type="file" name="image">
    </div> -->
    <div class="form-group">
    <label for="post-tags">Email</label>
    <input class="form-control" type="email" name="user_email"  value="<?php echo $user_email ;?>">
    </div>
    <div class="form-group">
    <label for="post-tags">Password</label>
    <input class="form-control" type="password" name="user_password"  value="<?php echo $user_password ;?>">
    </div>
    <div class="form-group">
    <input class="btn btn-primary" type="submit" name="edit_user" value="Update User" >
    </div>
</form>
</div>
