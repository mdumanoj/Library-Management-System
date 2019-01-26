<?php
	include 'dbconnect.php';
	session_start();
	if(!isset($_SESSION['name']))
		header("location:index.php");
 ?>
 <html>
	<head>
		<title>Staff_Home</title>
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
	</head>
	<style type="text/css">
		body {
			padding-top:1%;
			margin: 0px auto;
			background-color:#FFFFd6;
			font-family: cambria;
		}
		header {
			color: #404040;
			width: 100%;
		}
		h1 {
			font-family: cambria,'open sans';
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
			color: magenta;
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
			font-size: 18px;
			padding: 1%;;
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
		.table {
			margin-left: 10%;
			margin-top: 3%;
			width:80%;
		}
		table, th, td {
			border: 1px solid black;
			border-collapse: collapse;
			text-align: center;
			font-size:18px;
		}
		#lending {
			text-align:center;
			color: olive;
			height:100%;
			padding-top:1%;
		}
		#search {
			padding-top:1%;
			color: olive;
			text-align:center;
			height: 100%;
		}
		#result {
			margin-top:1%;
		}
		.searchtable, .reqtable {
			margin-top: 2%;
			margin-left:36%;
			border-radius:7px;
		}
		input[type="text"],input[type="password"] {
			padding-left:10px;
			border:1px solid #d7d7d7;
			border-radius:5px;
			height: 30px;
			width: 201px;
			font-size:16px;
		}
		input:focus {
			border-color: #625eee;
		}
		select {
			text-align:center;
			font-size:18px;
			border:1px solid #d7d7d7;
			border-radius:5px;
			padding:6px 10px;
		}
		#reqbook {
			padding-top:1%;
			color: olive;
			text-align: center;
			height: 100%;
		}
		.button {
			background-color: #444444;
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
			color: #444;
			background-color: #fff;
			cursor: pointer;
		}
		input[type="submit"] {
			height:40px;
			width:213px;
			font-size: 22px;
			border-radius:6px;
		}
		#chgpwd {
			padding-top:1%;
			color: olive;
			text-align: center;
			height: 100%;
		}
		.comment {
			font-size:16px;
			font-family:"sans serif";
			color:#dd4b39;
			padding-left:2%;
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
		.scrolltotop:hover {
			opacity: 0.7;
		}
		.buklist {
			float: right;
			margin-top:1%;
			margin-right:12%;
			color: #444;
			font-size: 20;
			font-family: cambria;
			font-weight: bold;
		}
	</style>
	<body>
		<header>
			<h1>Staff Home</h1>
            <hr></hr>
			<ul>
				<li>Welcome, <?php echo $_SESSION['name']; ?> </li>
				<li><a href="#lending">Lending Status</a></li>
				<li><a href="#search">Search</a></li>
				<li><a href="#reqbook">Request Book</a></li>
				<li><a href="#chgpwd">Change Password</a></li>
				<li><a href="faq.html">F.A.Q</a></li>
				<li class="right"><a href="logout.php">Logout</a></li>
			</ul>
			<hr></hr>
		</header>
		
		<!-- Scroll to top icon -->
		<a href="#" class="scrolltotop"></a>
		
		<!-- Lending Status division -->
		<?php
			$user = $_SESSION['unam'];
			$rows = array();
			$query = "select *from books where borrower_id='$user'";
			$result = $con -> query($query);
			$count = $result -> num_rows;
			if($count != 0) {
				while($row = $result -> fetch_array(MYSQLI_ASSOC)) {
					$rows[] = $row;
				}	
			}
		?>
		<div id="lending">
			<h1>Book Lending Status</h1>
			<?php
				echo "<table cellpadding='10' class='table'>";
				echo "<tr><th>Book Id</th><th>Book Name</th><th>Author</th><th>Publisher</th><th>Publication Year</th><th>Subject</th><th>Return Date</th></tr>";
				if($count == 0) {
					echo "<tr><td colspan='7'> --NIL-- </td>";
				}
				else {
					for($i=0;$i<$count;$i++)
						echo "<tr><td>".$rows[$i]['id']."</td><td>".$rows[$i]['book_name']."</td><td>".$rows[$i]['author_name']."</td><td>".$rows[$i]['publisher']."</td><td>".$rows[$i]['publication_year']."</td><td>".$rows[$i]['subject']."</td><td>".$rows[$i]['return_date']."</td></tr>";
				}
				echo "</table>";
			?>
		</div>
		<!--End Of Lending Status Division -->
		
		<!-- Search division -->
		<?php 
			if(isset($_GET['q'])) {
				$q = $_GET['q'];
				$rows = array();
				$searchby = $_GET['searchby'];
				$query = "select *from books where $searchby like '%$q%'";
				$result = $con -> query($query);
				$count = $result -> num_rows;
				$_SESSION['count'] = $count;
				if($count != 0) {
					while($row = $result -> fetch_array(MYSQLI_ASSOC)) {
						$rows[] = $row;
					}
					$_SESSION['rows'] = $rows;
				}
				if($count > 2) {
					$limit = 2;
				}
				else {
					$limit = $count;
				}
			}
		?>
		<div id="search">
			<h1>Search For Book</h1>
			<form name="searchbuk" action="studenthome.php" method="get" onsubmit="return searchValid();">
				<table cellpadding="10" class="searchtable">
					<tr><td>Search By</td><td>
						<select name="searchby">
							<option value="book_name">Book Name</option>
							<option value="author_name">Author Name</option>
							<option value="subject">Subject</option>
						</select>
					</td></tr>
					<tr><td>Looking For:</td><td><input type="text" name="q" placeholder="Search.."></td></tr>
					<tr><td colspan="2" align="center"><div class="comment" id="search_check"></div><br>
					<input type="submit" class="button" value="Search Book"></td></tr>
				</table>
			</form>
			<div id="result">
				<?php
					if(isset($_GET['q'])) {
						echo "<table cellpadding='10' class='table'>";
						echo "<tr><th>Book Id</th><th>Book Name</th><th>Author</th><th>Publisher</th><th>Publication Year</th><th>Subject</th><th>Status</th></tr>";
						if($count == 0) {
							echo "<tr><td colspan='7'>--No Results Found--</td></tr>";
						}
						else {
							for($i=0;$i<$limit;$i++) {
								echo "<tr>".
								"<td>".$rows[$i]['id']."</td>".
								"<td>".$rows[$i]['book_name']."</td>".
								"<td>".$rows[$i]['author_name']."</td>".
								"<td>".$rows[$i]['publisher']."</td>".
								"<td>".$rows[$i]['publication_year']."</td>".
								"<td>".$rows[$i]['subject']."</td>";
								if($rows[$i]['borrower_id'] == "") {
									echo "<td>".
										"<form action='studenthome.php' method='post' name='getbook'>".
										"<input type='hidden' name='id' value='".$rows[$i]['id']."'>".
										"<input type='submit' class='button' value='Get Book'>".
										"</form>".
										"</td>".
										"</tr>";
								}
								else {
									echo "<td>Borrowed By ".$rows[$i]['borrower_id']."</td>".
										"</tr>";
								}
							}
						}
						echo "</table>";
						if($limit < $count) {
							echo "<a href='booklist.php' class='buklist'>&rarr; See Full Book List.</a>";
						}
				?>
				<script type="text/javascript">
					window.location = "#search";
				</script>
				<?php
					}
					if(isset($_POST['id'])) {
						$bukid = $_POST['id'];
						$return = date("d-m-y",strtotime("+30 days"));
						$query = "update books set borrower_id='$user', return_date = '$return' where id='$bukid'";
						$result = $con -> query($query);
						if($result) {
							?>
							<script type="text/javascript">
								alert('Book added Successfully');
								window.location.reload();
							</script>
							<?php
						}
					}
				?>
				</table>
			</div>
		</div>
		<!--End Of Search Division -->
		
		<!-- Request Book division -->
		<div id="reqbook">
			<h1>Give Book Details</h1>
			<form name="reqbook" action="" onsubmit="return reqValid();">
				<table cellpadding="10" class="reqtable">
					<tr><td>Book Name</td><td><input type="text" name="bukname" placeholder="Enter Book name"></td></tr>
					<tr><td>Author Name</td><td><input type="text" name="authname" placeholder="Enter Author name"></td></tr>
					<tr><td>Publisher</td><td><input type="text" name="publisher" placeholder="Enter Publisher name"></td></tr>
					<tr><td>Subject</td><td><input type="text" name="sub" placeholder="Enter Subject"></td></tr>
					<tr><td colspan="2" align="center"><div class="comment" id="req_check"></div><br><input type="submit" class="button" value="Request Book"></td></tr>
				</table>
			</form>
		</div>
		<!--End Of Request Book Division -->
		
		<!-- Change Password Division -->
		<div id="chgpwd">
			<h1>Change Password</h1>
			<form name="chgpwd" action="staffhome.php" method="post" onsubmit="return chgpwdValid();">
				<table cellpadding="10" class="reqtable">
					<tr><td>Old Password:</td><td><input type="password" name="oldpwd" placeholder="Enter Old Password"></td></tr>
					<tr><td>New Password:</td><td><input type="password" name="newpwd" placeholder="Enter New Password"></td></tr>
					<tr><td>Re-Enter Password:</td><td><input type="password" name="rnewpwd" placeholder="Re-Enter New Password"></td></tr>
					<tr><td colspan="2" align="center"><div class="comment" id="chgpwd_check"></div><br>
					<input type="submit" class="button" value="Change Password"></td></tr>
				</table>
			</form>
		</div>
		<?php
			if(isset($_POST['oldpwd'])) {
				$oldpwd = $_POST['oldpwd'];
				$sql = "select *from stafflogin where password='$oldpwd'";
				$result = $con -> query($sql);
				$count = $result -> num_rows;
				if($count == 0) { ?>
					<script type="text/javascript">
						document.getElementById('chgpwd_check').innerHTML = "Incorrect Old Password";
						window.location = "#chgpwd";
					</script>
				<?php
				}
				else {
					$newpwd = $_POST['newpwd'];
					$query = "update stafflogin set password='$newpwd' where password='$oldpwd'";
					$result = $con -> query($query);
					if($result) { ?>
						<script type="text/javascript">
							alert("Password changed Successfully");
						</script>
					<?php
					}
				}
			}
		?>
		<!--End Of Change Password Division -->
	</body>
	<!--End Of HTML -->
	
	<!-- Script starts here -->
	<script type="text/javascript">
		function searchValid() {
			search = document.forms['searchbuk']['q'].value;
			if(search == "") {
				document.getElementById("search_check").innerHTML = "Please Enter Book Details";
				return false;
			}
		}
		//Validation of Request Book.
		function reqValid() {
			bukname = document.forms['reqbook']['bukname'].value;
			authname = document.forms['reqbook']['authname'].value;
			publisher = document.forms['reqbook']['publisher'].value;
			subject = document.forms['reqbook']['sub'].value;
			if(bukname == "") {
				document.getElementById("req_check").innerHTML = "Please Enter Book Name";
				return false;
			}
			else if(authname == "") {
				document.getElementById("req_check").innerHTML = "Please Enter Author Name";
				return false;
			}
			else if(publisher == "") {
				document.getElementById("req_check").innerHTML = "Please Enter Publisher";
				return false;
			}
			else if(subject == "") {
				document.getElementById("req_check").innerHTML = "Please Enter Subject";
				return false;
			}
		}
		//Validation of Change Password field
		function chgpwdValid() {
			oldpwd = document.forms['chgpwd']['oldpwd'].value;
			newpwd = document.forms['chgpwd']['newpwd'].value;
			rnewpwd = document.forms['chgpwd']['rnewpwd'].value;
			if(oldpwd == "") {
				document.getElementById("chgpwd_check").innerHTML = "Please Enter Old Password";
				return false;
			}
			else if(newpwd == "") {
				document.getElementById("chgpwd_check").innerHTML = "Please Enter New Password";
				return false;
			}
			else if(rnewpwd == "") {
				document.getElementById("chgpwd_check").innerHTML = "Please Re-Enter New Password";
				return false;
			}
			else if(newpwd != rnewpwd) {
				document.getElementById("chgpwd_check").innerHTML = "Password does not match";
				return false;
			}
		}
	</script>
</html>