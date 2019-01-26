<?php  
	include 'dbconnect.php';
	session_start();
	if(!isset($_SESSION['name']))
		header("location:index.php");
 ?>
 <html>
	<head>
		<title>Book List</title>
		<link rel="stylesheet" href="style.css">
	</head>
	<style type="text/css">
		h2 {
			float:right;
			margin-right:13%;
		}
		.go_back {
			font-size: 20px;
		}
	</style>
	<body>
		<hr>
		<header>
			<h1 style="padding-left:33%; font-family: cambria;">Books You May Need</h1>
		</header>
		<hr>
		<table cellpadding='10' class='table'>
			<tr><th>Book Id</th><th>Book Name</th><th>Author</th><th>Publisher</th><th>Publication Year</th><th>Subject</th><th>Status</th></tr>
		<?php 
			$count = $_SESSION['count'];
			$rows = array();
			$rows = $_SESSION['rows'];
			for($i=0;$i<$count;$i++) {
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
					echo "<td>Borrwed By ".$rows[$i]['borrower_id']."</td>".
						"</tr>";
				}
			}
		?>
		</table>
		<div class="go_back">
			<h2><a href="studenthome.php">&#8629; Go Back</a></h2>
		</div>
	</body>
</html>