<?php  include "includes/db.php"; ?>
<?php  ob_start(); ?>
<?php  session_start(); ?>
<?php include "includes/function.php";?>
<?php
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);
    $error = [
        'username'=> '',
        'email'=> '',
        'password'=> ''
    ];
    if(strlen($username) < 4){
        $error['username'] = 'Username needs to be longer';
    }
    if($username == ''){
        $error['username'] = 'Username cannot be empty';
    }
    if(username_exists($username)){
        $error['username'] = 'Username already exists! Choose another one';
    }
    if($email == ''){
        $error['email'] = 'Email cannot be empty';
    }
    if(email_exists($username)){
        $error['email'] = 'Email already exists! <a href ="index.php">Please Log In</a>';
    }
    if($password == ''){
        $error['password'] = 'Password cannot be empty';
}
foreach ($error as $key => $value) {
    if(empty($value)){
        unset($error[$key]);
    }
   }//foreach
   if(empty($error)){
    register_user($username, $email, $password);
    login_user($username, $password);
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Get the best!</title>

    <!-- Bootstrap Core CSS -->
    <link href="/cms/css/bootstrap.min.css" rel="stylesheet">
<!--=============================================/cms/==================================================-->
	<link rel="stylesheet" type="text/css" href="/cms/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--=============================================/cms/==================================================-->
	<link rel="stylesheet" type="text/css" href="/cms/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--=============================================/cms/==================================================-->
	<link rel="stylesheet" type="text/css" href="/cms/vendor/animate/animate.css">
<!--=============================================/cms/==================================================-->
	<link rel="stylesheet" type="text/css" href="/cms/vendor/css-hamburgers/hamburgers.min.css">
<!--=============================================/cms/==================================================-->
	<link rel="stylesheet" type="text/css" href="/cms/vendor/animsition/css/animsition.min.css">
<!--=============================================/cms/==================================================-->
	<link rel="stylesheet" type="text/css" href="/cms/vendor/select2/select2.min.css">
<!--=============================================/cms/==================================================-->
	<link rel="stylesheet" type="text/css" href="/cms/vendor/daterangepicker/daterangepicker.css">

    <!-- Custom CSS -->
    <link href="/cms/css/blog-home.css" rel="stylesheet">

    <link href="/cms/css/styles.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/cms/css/util.css">
    <link rel="stylesheet" type="text/css" href="/cms/css/main.css">
    <link rel="stylesheet" type="text/css" href="/cms/css/newhomestyle.css">
    


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
   <!-- Navigation -->  
   <?php  include "includes/navigation.php"; ?>
    <!-- Page Content -->
        <div class="container-contact100">
		<div class="contact100-map" id="google_map" data-map-x="40.722047" data-map-y="-73.986422" data-pin="images/icons/map-marker.png" data-scrollwhell="0" data-draggable="1"></div>

		<div class="wrap-contact100">
			<div class="contact100-form-title" style="background-image: url(images/bg-01.jpg);">
				<span class="contact100-form-title-1">
					Register
				</span>

				<span class="contact100-form-title-2">
					Complete all necessary information!
				</span>
			</div>

			<form role="form" action="registration.php" method="post" id="login-form" autocomplete="off" class="contact100-form validate-form">
				<div class="wrap-input100 validate-input" data-validate="Name is required">
					<span class="label-input100">Username:</span>
					<input class="input100" type="text" name="username" id="username" autocomplete="on" placeholder="Enter Username" value="<?php echo isset($username) ? $username : '' ?>">
                    <span class="focus-input100"></span>
                    <p><?php echo isset($error['username']) ? $error['username'] : '' ?></p>
				</div>

				<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
					<span class="label-input100">Email:</span>
					<input class="input100" type="email" name="email" id="email" class="form-control" autocomplete="on" placeholder="Enter email address" value="<?php echo isset($email) ? $email : '' ?>">
                    <span class="focus-input100"></span>
                    <p><?php echo isset($error['email']) ? $error['email'] : '' ?></p>
				</div>

				<div class="wrap-input100 validate-input" data-validate="Phone is required">
					<span class="label-input100">Password:</span>
					<input class="input100" type="password" name="password" id="key" placeholder="Password">
                    <span class="focus-input100"></span>
                    <p><?php echo isset($error['password']) ? $error['password'] : '' ?></p>
				</div>

				<div class="container-contact100-form-btn">
					<button class="contact100-form-btn" type="submit" name="register" id="btn-login" value="Register">
						<span>
							Register
							<i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
						</span>
					</button>
				</div>
			</form>
		</div>
	</div>



	<div id="dropDownSelect1"></div>



<?php include "includes/footer.php";?>
