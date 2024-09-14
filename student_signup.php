<?php
include('admin/dbcon.php');
include('admin/mail.php');
//session_start();
if (isset($_POST['login'])) {
	
$username = $_POST['username'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
if ($password != $cpassword	) {
echo "<script>alert('Password Missmatch')</script>";
	header("location:signup_student.php");
}else{

$query = mysqli_query($conn,"select * from student where semail='$username'  ")or die(mysqli_error());

$count = mysqli_num_rows($query);
if ($count > 0){
echo "<script>alert('student already exist	 in the database	 please check and try again')</script>";
	header("location:signup_student.php");

}else{
		$endpass = sha1($password);
	$ins = mysqli_query($conn,"INSERT INTO student (firstname,lastname,password,semail) VALUES('$firstname','$lastname','$endpass','$username')") or die(mysqli_error());
		if ($ins) {
			    $student_id = mysqli_insert_id($conn);
			    $user="PG00".$student_id;
$msg = "Dear $firstname $lastname,<br><br>

We are pleased to welcome you to the University’s e-Learning platform. This platform has been designed to enhance your learning experience, providing you with access to a wide range of resources and tools to support your academic journey.<br><br>

Below are your login details to access the platform:<br><br>

<strong>Username:</strong> $user<br>
<strong>Password:</strong> $password<br><br>

Please ensure that you keep this information secure. If you encounter any issues logging in, do not hesitate to reach out to our support team for assistance.<br><br>

We encourage you to explore the platform and make the most of the resources available to you. Should you have any questions or need further guidance, the University ICT Team is here to assist you.<br><br>

Thank you for being a part of our academic community. We wish you all the best in your studies.<br><br>

Best Regards,<br><br>

Prachi Sherya<br>
University ICT Team";

			   $upd = mysqli_query($conn, "UPDATE student SET username ='$user' WHERE student_id = $student_id");
			   if ($upd) {
			   	sending($username,"STUDENT LOGIN DETAILS", $msg);
			   	header("location:index.php");
			   }

		}

}	
}
}
?>