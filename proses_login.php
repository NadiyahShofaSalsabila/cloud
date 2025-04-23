<?php
	if(isset($_POST['submit']))
	{
		include 'koneksidb.php';

		$username =  $_POST['username'];
		$pass = $_POST['password'];

		$query = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username = '".$username."' AND password = '".$pass."' "); 

		$data = mysqli_fetch_array($query);


		if (mysqli_num_rows($query)>0) 
		{
			session_start();
			$_SESSION['username'] = $data['username'];
			$_SESSION['user_role'] = $data['user_role'];

			header('location: index.php');
		} 
		else 
		{
			$error = true;
		}
	}
?>
