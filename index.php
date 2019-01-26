<html>
	<head>
		<title>Library Management System</title>
	</head>
	<style type="text/css">
		body {
			padding-top:1%;
			margin: 0px auto;
			background-color:#FFFFd6;
			font-family: cambria;
			color: #444;
		}
		header {
			color: #505050;
			text-align: center;
		}
		h1 {
			font-weight: 300;
		}
		.content {
			font-size: 22px;
			opacity:0.8;
		}
		.description {
			margin:1%;
			text-indent:3%;;
		}
		.login {
			Background:#ffffbb;
			margin-left:30%;
			padding-left:5%;
			margin-top:3%;
			padding-top:1%;
			padding-bottom:1%;
			margin-right:41%;
			border-radius:7px;
			box-shadow: 2px 2px 2px 2px #a7a7a7;
			opacity:0.8;
		}
		td,th {
			font-size:18px;
			font-weight:bold;
			opacity:0.8;
		}
		input[type="text"],input[type="password"] {
			padding-left:10px;
			border:1px solid #d7d7d7;
			border-radius:5px;
			height:38px;
			width:213px;
			font-size:15px;
		}
		select {
			width:210px;
			height:36px;
			text-align:center;
			font-size:18px;
			border:1px solid #d7d7d7;
			border-radius:5px;
			padding:6px 10px;
		}
		input[type="submit"] {
			height:40px;
			width:213px;
			font-size: 22px;
			border-radius:6px;
		}
		.button {
			background-color: #222;
			color:#fff;
			border:1px solid #fff;
			padding: 0px;
		}
		.button:hover {
			border: 1px solid #444;
			background-color: #444;
			cursor: pointer;
		}
		input:focus {
			box-shadow: 0 -1px 0 rgba(0, 0, 0, 0.3), 0 1px 2px rgba(0, 0, 0, 0.1) inset, 0 0 10px rgba(255, 255, 255, 0.9);
		}
		.comment {
			font-size:15px;
			font-family:"sans serif";
			color:#dd4b39;
			padding-left:2%;
		}
	</style>
	<!-- End Of CSS -->
	<body>
		<header>
			<h1>KLNCE Library Management System</h1>
		</header>
		<hr></hr>
		<section>
			<div class="description">
				<p class="content">
					This application is aimed at developing an online Library Management System (LiMS) for the college library. This is an Intranet based application that can be accessed throughout the campus. This system can be used to search for books/magazines, reserve books, find out who is having a particular book, put in requests to buy a new book etc. This is one integrated system that contains both the user component and the librarian component. 
				</p>
			</div>
			<div class="login">
				<form name="login" action="index.php" method="post" onsubmit="return valid();">
					<table cellpadding="5">
					<tr><th>Login to the System</th></tr>
					<tr><td><input type="text" name="uname" placeholder="Enter Username"></td></tr>
					<tr><td><input type="password" name="pwd" placeholder="Enter Password"></td></tr>
					<tr><td>Login As</td></tr>
					<tr><td>
					<select name="login_as">
						<option value="student">Student</option>
						<option value="staff">Staff</option>
						<option value="librarian">Librarian</option>
					</select><br>
					<div class="comment" id="check"></div></td></tr>
					<tr><td><input type="submit" class="button" value="Login"></td></tr>
					</table>
				</form>
			</div>
		</section>
	</body>
	<!--End Of HTML -->
	<!-- Validation Script starts here -->
	<script type="text/javascript">
		function valid() {
			un = document.forms['login']['uname'].value;
			pass = document.forms['login']['pwd'].value;
			if(un == "") {
				document.getElementById("check").innerHTML = "Please Enter Username";
				return false;
			}
			else if(pass == "") {
				document.getElementById("check").innerHTML = "Please Enter Password";
				return false;
			}
		}
	</script>
	<!-- End of Validation Script -->
</html>

<?php
include 'dbconnect.php';
if(isset($_POST['uname']) && isset($_POST['pwd'])) {
	$user = $_POST['uname'];
	$pass = $_POST['pwd'];
	$login_as = $_POST['login_as'];
	
	//Checking for Student Login..
	if($login_as == "student") {
		$sql = "select *from studentlogin where username='$user' and BINARY password='$pass'";
		$result = $con -> query($sql);
		$count = $result -> num_rows;
		if($count == 0){ ?>
			<script type="text/javascript">
				document.getElementById('check').innerHTML = "Incorrect Username or Password";
			</script>
		<?php }
		else {
			session_start();
			$query = "select name from studentlogin where username='$user' and password='$pass'";
			$result = $con -> query($query);
			$name = $result -> fetch_array(MYSQLI_ASSOC);
			$_SESSION['name'] = $name['name'];
			$_SESSION['unam'] = $user;
			$_SESSION['pasw'] = $pass;
			if(isset($_SESSION['unam']) && isset($_SESSION['pasw']))
				header("location:studenthome.php");
		} 
	}
	
	//Checking for Staff Login..
	else if($login_as == "staff") {
		$sql = "select *from stafflogin where username='$user' and BINARY password='$pass'";
		$result = $con -> query($sql);
		$count = $result -> num_rows;
		if($count == 0){ ?>
			<script type="text/javascript">
				document.getElementById('check').innerHTML = "Incorrect Username or Password";
			</script>
		<?php }
		else {
			session_start();
			$query = "select name from stafflogin where username='$user' and password='$pass'";
			$result = $con -> query($query);
			$name = $result -> fetch_array(MYSQLI_ASSOC);
			$_SESSION['name'] = $name['name'];
			$_SESSION['unam']=$user;
			$_SESSION['pasw']=$pass;
			if(isset($_SESSION['unam']) && isset($_SESSION['pasw']))
				header("location:staffhome.php");
		} 
	}
	
	//Checking for Librarian Login..
	else if($login_as == "librarian") {
		$sql = "select *from liblogin where username='$user' and BINARY password='$pass'";
		$result = $con -> query($sql);
		$count = $result -> num_rows;
		if($count == 0){ ?>
			<script type="text/javascript">
				document.getElementById('check').innerHTML = "Incorrect Username or Password";
			</script>
		<?php }
		else {
			session_start();
			$query = "select name from liblogin where username='$user' and password='$pass'";
			$result = $con -> query($query);
			$name = $result -> fetch_array(MYSQLI_ASSOC);
			$_SESSION['name'] = $name['name'];
			$_SESSION['unam']=$user;
			$_SESSION['pasw']=$pass;
			if(isset($_SESSION['unam']) && isset($_SESSION['pasw']))
				header("location:libhome.php");
		} 
	}
}
?>