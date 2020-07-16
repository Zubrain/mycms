<?php
if(isset($_POST['create_user'])){

    
    // $user_id = $_POST['user_id'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];


    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    // $query = "SELECT randSalt FROM users";
    // $select_randsalt_query = mysqli_query($connection, $query);
    // confirmQuery($select_randsalt_query);
    //         $row = mysqli_fetch_array($select_randsalt_query);
    //         $salt = $row['randSalt'];
    //         $hash_password = crypt($user_password, $salt); 
    $hash_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));
       
    $query = "INSERT INTO users(user_firstname, user_lastname, user_role,username, user_email, user_password) ";
    $query.= "VALUES( '{$user_firstname}','{$user_lastname}','{$user_role}','{$username}','{$user_email}','{$hash_password}') ";

    $create_user_query = mysqli_query($connection,$query);
    confirmQuery($create_user_query);
    echo "User Created:"." "."<a href='users.php'>View Users</a>";

}


?>
<div class="col-md-8">
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
    <label for="post-title">Firstname</label>
    <input class="form-control" type="text" name="user_firstname" >
    </div>
    <div class="form-group">
    <label for="author">Lastname</label>
    <input class="form-control" type="text" name="user_lastname" >
    </div>
    <div class="form-group">
    <label for="user-role">User Role</label>
    <select class="form-control" name="user_role" id="user_role">
     <option value="subscriber">Select Options</option>
     <option value="admin">Admin</option>
     <option value="subscriber">Subscriber</option>

          </select>        
    </div>
    <div class="form-group">
    <label for="username">Username</label>
    <input class="form-control" type="text" name="username" >
    </div>
    <!-- <div class="form-group">
    <label for="post-image">Post Image</label>
    <input type="file" name="image">
    </div> -->
    <div class="form-group">
    <label for="post-tags">Email</label>
    <input class="form-control" type="email" name="user_email" >
    </div>
    <div class="form-group">
    <label for="post-tags">Password</label>
    <input class="form-control" type="password" name="user_password" >
    </div>
    <div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_user" value="Add User" >
    </div>
</form>
</div>
