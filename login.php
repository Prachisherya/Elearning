<?php
		include('admin/dbcon.php');
		session_start();
		$username = $_POST['username'];
		$password = sha1($_POST['password']);
		/* student */
			$query = "SELECT * FROM student WHERE username='$username' AND password='$password'";
			$result = mysqli_query($conn,$query)or die(mysqli_error());
			$row = mysqli_fetch_array($result);
			$num_row = mysqli_num_rows($result);


		if( $num_row > 0 ) { 
		$_SESSION['id']=$row['student_id'];
		echo 'true_student';	
		}else{ 
				echo 'false';
		}	
				
		?>