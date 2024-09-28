<?php 
	session_start();
	ob_start(); 
	require ('config.php');

	$email = $_POST['email'];
	$password = $_POST['password'];

	$result_statement = mysqli_prepare($con, "SELECT * FROM `user` WHERE `email` = ? AND `password` = ?");
	$result_statement->bind_param("ss",$email,$password);
	$result_statement->execute();
	$result_query=$result_statement->get_result();
	$row = mysqli_fetch_array($result_query);
	$count_query = mysqli_num_rows($result_query);

	if ($count_query != 0) {
		$sessionemail = $row['email'];
		$_SESSION['login_user']= $sessionemail;
		header("Location: ../adminpage.php");
		exit();
	} 
	else {
		echo '<script>alert("Incorrect Credentials Entered"); location.replace(document.referrer);</script>';
	}
?>