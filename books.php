<?php  
	include 'dbconnect.php';
	session_start();
	if(!isset($_SESSION['name'])) 
		header("location:index.php");
 ?>
<html>
	<head>
		<title>ALL BOOKS</title>
		<link rel="stylesheet" href="style.css" type="text/css">
		<style>
			h1 {
				padding-left:33%;
			}
			.books {
				margin-top:3%;
				width:90%;
			}
			h2 {
				float:right;
				margin-right:13%;
			}
			.go_back {
				margin-top: 1%;
				font-size: 23px;
			}
		</style>
	</head>
	<body>
		<header>
			<h1>All Books in Library</h1>
			<hr></hr>
		</header>
		<div class="all_books">
			<?php
				$rows = array();
				$query = "select *from books";
				$result = $con -> query($query);
				$count = $result -> num_rows;
				while($row = $result -> fetch_array(MYSQLI_ASSOC)) {
					$rows[] = $row;
				}
				echo "<table cellpadding='10' class='books'>";
				echo "<tr><th>Book Id</th><th>Book Name</th><th>Author</th><th>Publisher</th><th>Publication Year</th><th>Subject</th><th>Borrowed By</th><th>Return Date</th></tr>";
				for($i=0;$i<$count;$i++) {
					echo "<tr><td>".$rows[$i]['id']."</td><td>".$rows[$i]['book_name']."</td><td>".$rows[$i]['author_name']."</td><td>".$rows[$i]['publisher']."</td><td>".$rows[$i]['publication_year']."</td><td>".$rows[$i]['subject']."</td><td>".$rows[$i]['borrower_id']."</td><td>".$rows[$i]['return_date']."</td></tr>";
				}
				echo "</table>";
			?>
		</div>
		<div class="go_back">
			<h2><a href="libhome.php">&#8629; Go Back</a></h2>
		</div>
	</body>
</html>