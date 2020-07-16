<?php
function redirect($location){
    return header("Location:". $location);
} 

function username_exists($username){
    global $connection;
    $query = "SELECT user_role FROM users WHERE username = '$username' ";
    $result = mysqli_query($connection, $query);
    if(!$result){
        die("QUERY FAILED .". mysqli_error($connection));
}
    if(mysqli_num_rows($result) > 0){
        return true;
    }else{
        return false;
    }
}

function email_exists($email){
    global $connection;
    $query = "SELECT user_role FROM users WHERE user_email = '$email' ";
    $result = mysqli_query($connection, $query);
    if(!$result){
        die("QUERY FAILED .". mysqli_error($connection));
}
    if(mysqli_num_rows($result) > 0){
        return true;
    }else{
        return false;
    }
}

function register_user($username, $email, $password){
    global $connection;
         $username = mysqli_real_escape_string($connection, $username);
         $email = mysqli_real_escape_string($connection, $email);
         $password = mysqli_real_escape_string($connection, $password);

         $hash_password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

         $query = "INSERT INTO users(username,user_email,user_password,user_role) ";
         $query.= "VALUES('{$username}','{$email}','{$hash_password}','subscriber') ";
         $register_query = mysqli_query($connection, $query);
         if(!$register_query){
            die("QUERY FAILED .". mysqli_error($connection));
    }
        }

    function login_user($username, $password){
        global $connection; 
         $username = mysqli_real_escape_string($connection, $username);
         $password = mysqli_real_escape_string($connection, $password);
 
            $query = "SELECT * FROM users WHERE username = '{$username}' ";
            $select_user_query = mysqli_query($connection,$query);
            if(! $select_user_query){
                die("QUERY FAILED".mysqli_error($connection));
            }
            while($row = mysqli_fetch_array($select_user_query)){
                $db_user_id = $row['user_id'];
                $db_username = $row['username'];
                $db_user_password = $row['user_password'];
                $db_user_firstname = $row['user_firstname'];
                $db_user_lastname = $row['user_lastname'];
                $db_user_role = $row['user_role'];
            }
            if(password_verify($password, $db_user_password)){
                $_SESSION['username'] = $db_username;
                $_SESSION['firstname'] = $db_user_firstname;
                $_SESSION['lastname'] = $db_user_lastname;
                $_SESSION['user_role'] = $db_user_role;
                redirect("/cms/admin");
            }else{
                redirect("/cms/index.php");
            }
                }
?>