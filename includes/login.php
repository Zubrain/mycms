<?php session_start(); ?>
    <?php include "db.php"; ?>
    <?php include "function.php"; ?>
<?php 
if(isset($_POST['username']) && isset($_POST['password'])){

    login_user($_POST['username'], $_POST['password']);


}else {


    redirect('/cms/login.php');
}
?>
