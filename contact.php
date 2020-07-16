<?php  include "includes/db.php"; ?>
<?php  ob_start(); ?>
<?php  session_start(); ?>
<?php include "includes/function.php";?>
<?php
if(isset($_POST['submit'])){
    $to         = "ncjideama1@gmail.com";
    $subject    = wordwrap($_POST['subject'],70);
    $body       = $_POST['body'];
    $header     = "FROM: ".$_POST['email'];
    mail($to, $subject, $body, $header);
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
					Contact Us
				</span>

				<span class="contact100-form-title-2">
					Feel free to drop us a message below!
				</span>
			</div>

			<form class="contact100-form validate-form">
				<div class="wrap-input100 validate-input" data-validate="Name is required">
					<span class="label-input100">Full Name:</span>
					<input class="input100" type="text" name="name" placeholder="Enter full name">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
					<span class="label-input100">Email:</span>
					<input class="input100" type="email" name="email" id="email" class="form-control" placeholder="Enter email addess">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate="Phone is required">
					<span class="label-input100">Phone:</span>
					<input class="input100" type="text" name="phone" placeholder="Enter phone number">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate = "Message is required">
					<span class="label-input100">Message:</span>
					<textarea class="input100"  name="body" id="body" placeholder="Your Message..."></textarea>
					<span class="focus-input100"></span>
				</div>

				<div class="container-contact100-form-btn">
					<button class="contact100-form-btn">
						<span>
							Submit
							<i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
						</span>
					</button>
				</div>
			</form>
		</div>
	</div>



	<div id="dropDownSelect1"></div>



<?php include "includes/footer.php";?>
