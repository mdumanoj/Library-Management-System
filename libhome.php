<?php  
	include 'dbconnect.php';
	session_start();
	if(!isset($_SESSION['name']))
		header("location:index.php");
 ?>
 <html>
	<head>
		<title>Librarian_Home</title>
		<script src="jquery-2.1.0.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('li a').click(function(){
					$('html, body').animate({
					scrollTop: $( $.attr(this, 'href') ).offset().top
					}, 700);
					return false;
				});
				
				//Scroll to Top Code.
				$(window).scroll(function(){
					if ($(this).scrollTop() > 100) {
						$('.scrolltotop').fadeIn();
					} else {
						$('.scrolltotop').fadeOut();
					}
				});
	
				//Click event to scroll to top
				$('.scrolltotop').click(function(){
					$('html, body').animate({scrollTop : 0},700);
					return false;
				});
			})
		</script>
		<style type="text/css">
			body {
				padding-top: 1%;
				margin: 0px auto;
				background-color:#FFFFd6;
				font-family: Helvetica;
			}
			header {
				color: #505050;
			}
			h1 {
				font-family: 'open sans';
				font-size: 35px;
				margin-left:3%;
				font-weight:300;
			}
			a {
				text-decoration: none;
				color: olive;
				-moz-transition: 0.3s color linear;
				-webkit-transition: 0.3s color linear;
				transition: 0.3s color linear;
			}
			a:hover {
				color: violet;
				text-decoration: underline;
				cursor: pointer;
			}
			.right {
				float: right;
				margin-top:-1%;
				margin-right:5%;
			}
			li {
				display: inline;
				padding: 1%;
			}
			ul {
				font-weight: bold;
			}
			select {
				width:200px;
				height:32px;
				text-align:center;
				font-size:14px;
				border:1px solid #d7d7d7;
				border-radius:5px;
				padding:6px 10px;
			}
			input[type="text"],input[type="number"],input[type="password"] {
				padding-left:10px;
				border:1px solid #d7d7d7;
				border-radius:5px;
				height: 30px;
				width: 201px;
				font-size:16px;
			}
			input[type="submit"] {
				height:40px;
				width:213px;
				font-size: 22px;
				border-radius:6px;
			}
			input:focus {
				border-color: #625eee;
			}
			.button {
				background-color: #555;
				color:#fff;
				border:1px solid #fff;
				padding-bottom: 1%;
				transition: 0.2s color ease;
				-webkit-transition: 0.2s color ease;
				-moz-transition: 0.2s color ease;
				transition: 0.2s background-color linear;
				-webkit-transition: 0.2s background-color linear;
				-moz-transition: 0.2s background-color linear;
			}
			.button:hover {
				border: 1px solid #008080;
				color: #999;
				background-color: #222;
				cursor: pointer;
			}
			.table {
				margin-top: 2%;
				margin-left:36%;
				border-radius:7px;
			}
			table, th, td {
				border: 1px solid black;
				border-collapse: collapse;
				font-size:18px;
			}
			.scrolltotop {
				background-image: url("scroll1.png");
				background-repeat: no-repeat;
				float:right;
				padding: 1%;
				position: fixed;
				bottom:15px;
				right:10px;
				display: none;
				opacity:0.5;
				text-decoration: none;
				width:66px;
				height:60px;
			}
			.comment {
				font-size:16px;
				font-family:"sans serif";
				color:#dd4b39;
				padding-left:2%;
			}
			.scrolltotop:hover {
				opacity: 0.7;
			}
			#adduser,#addbook {
				text-align:center;
				color: olive;
				height:100%;
				padding-top:1%;
			}
		</style>
	</head>
	<body>
		<header>
			<h1>Librarian Home</h1>
			<hr></hr>
			<ul>
				<li>Welcome, <?php echo $_SESSION['name']; ?></li>
				<li><a href="books.php">Browse All Books</a></li>
				<li><a href="#adduser">Add User</a></li>
				<li><a href="#addbook">Add Books</a></li>
				<li><a href="#">Remove Books</a></li>
				<li><a href="#">Requested Books</a></li>
				<li><a href="#chgpwd">Change Password</a></li>
				<li><a href="faq.html">F.A.Q</a></li>
				<li class="right"><a href="logout.php">Log out</a></li>
			</ul>
			<hr></hr>
		</header>
		
		<!-- Scroll to top icon -->
		<a href="#" class="scrolltotop"></a>
		<!-- End Of scrolltotop div -->
		
		<!--Add user division -->
		<div id="adduser">
			<h1>Add New User</h1>
			<form action="libhome.php" method="post" onsubmit="return validUser();">
				<table cellpadding="10" class="table">
					<tr><td>Name</td><td><input type="text" name="name" placeholder="Enter Fullname"></td></tr>
					<tr><td>Department</td><td><input type="text" name="dept" placeholder="Enter Department"></td></tr>
					<tr><td>Year</td><td><input type="number" min="1" max="4" name="year" placeholder="Enter Year"></td></tr>
					<tr><td>Username</td><td><input type="text" name="uname" placeholder="Enter Username"></td></tr>
					<tr><td>Enter Password</td><td><input type="password" name="pwd" placeholder="Enter Password"></td></tr>
					<tr><td>Re-Type Password</td><td><input type="password" name="repwd" placeholder="Re-Enter Password"></td></tr>
					<tr><td>User Type</td>
					<td>
					<select name="user_type">
						<option value="student">Student</option>
						<option value="staff">Staff</option>
					</select></td></tr>
					<tr><td colspan="2" align="center"><div class="comment" id="check"></div><br>
					<input type="submit" class="button" value="Add User"></td></tr>
				</table>
			</form>
		</div>
		<!-- End of add user Division -->
		
		<!-- Add books Division -->
		<div id="addbook">
			<h1>Add Book to Library</h1>
			<form action="libhome.php" method="post" onsubmit="return bukValid();">
				<table cellpadding="10" class="table">
					<tr><td>Book ID:</td><td><input type="text" name="bukid" placeholder="Enter Book ID"></td></tr>
					<tr><td>Book Name:</td><td><input type="text" name="bukname" placeholder="Enter Book Name"></td></tr>
					<tr><td>Book Name:</td><td><input type="text" name="bukname" placeholder="Enter Book Name"></td></tr>
					<tr><td>Author Name:</td><td><input type="text" name="authname" placeholder="Enter Author Name"></td></tr>
					<tr><td>Publisher:</td><td><input type="text" name="publisher" placeholder="Enter Publisher of Book"></td></tr>
					<tr><td>Publication Year:</td><td><input type="text" name="pubyear" placeholder="Enter Year Of Publication"></td></tr>
					<tr><td>Subject:</td><td><input type="text" name="sub" placeholder="Enter Subject"></td></tr>
					<tr><td colspan="2" align="center"><input type="submit" value="Add Book" class="button"></td></tr>
				</table>
			</form>
		</div>
	</body>
</html>