<?php

	$host = "303.itpwebdev.com";
	$user = "jersongu_db_itp";
	$password = "CECSLogitech2428";
	$db = "jersongu_dvd_db";

	$today = date("Y-m-d");

	//Instance of mysqli class
	$mysqli = new mysqli($host, $user, $password, $db);

	//Check if there was an error connecting 
	if($mysqli->connect_errno){
		//echo out error message and exit program. There is no need to go on if there is no DB connection
		echo $mysqli->connect_errno;
		exit();
	}
	$mysqli->set_charset("utf8");
	//Need to get DVD title, release date, genre, rating
	$query = "SELECT title, release_date, genres.genre, ratings.rating 
	FROM dvd_titles
    JOIN genres
		ON dvd_titles.genre_id = genres.genre_id
	JOIN ratings
		ON dvd_titles.rating_id = ratings.rating_id
	WHERE 1=1 ";

	if(isset($_GET["title"]) && !empty($_GET["title"])){
		$query = $query . "AND dvd_titles.title LIKE '%" . $_GET["title"] . "%'";
	}


	if(isset($_GET["genre"]) && !empty($_GET["genre"])){
		$query = $query . "AND dvd_titles.genre_id =". $_GET["genre"]. " "; 
	}

	if(isset($_GET["rating"]) && !empty($_GET["rating"])){
		echo "HUUUHHHHHH";
		$query = $query . "AND dvd_titles.rating_id =". $_GET["rating"]. " "; 
	}

	if(isset($_GET["label"]) && !empty($_GET["label"])){
		$query = $query . "AND dvd_titles.label_id =". $_GET["label"]. " "; 
	}

	if(isset($_GET["format"]) && !empty($_GET["format"])){
		$query = $query . "AND dvd_titles.format_id =". $_GET["format"]. " "; 
	}

	if(isset($_GET["sound"]) && !empty($_GET["sound"])){
		$query = $query . "AND dvd_titles.sound_id =". $_GET["sound"]. " "; 
	}

	 if(!strcmp("no", $_GET["award"])){
	 	$query = $query . "AND dvd_titles.award IS NULL";
	 }
	 else if(!strcmp("yes", $_GET["award"])){
	 	$query = $query . "AND dvd_titles.award IS NOT NULL";
	 }


	 if(isset($_GET["release_date_to"]) && empty($_GET["release_date_to"])&& isset($_GET["release_date_from"]) && !empty($_GET["release_date_from"])){
	 	$query = $query . "AND dvd_titles.release_date BETWEEN '". $_GET["release_date_from"] . "' AND '" . $today . "' AND dvd_titles.release_date IS NOT NULL"; 
	 	echo "In the if";
	 }	
	 else if(isset($_GET["release_date_to"]) && !empty($_GET["release_date_to"])&& isset($_GET["release_date_from"]) && empty($_GET["release_date_from"])){
	 	$query = $query . "AND dvd_titles.release_date < '" .$_GET["release_date_to"]."' AND dvd_titles.release_date IS NOT NULL";
	 	echo "in the first else if";
	 }

	 else if(isset($_GET["release_date_to"]) && !empty($_GET["release_date_to"]&& isset($_GET["release_date_from"]) && !empty($_GET["release_date_from"]))){
	 	$query = $query . "AND dvd_titles.release_date BETWEEN '". $_GET["release_date_from"] . "' AND '" . $_GET["release_date_to"] . "' AND dvd_titles.release_date IS NOT NULL";
	 	echo "in the second else if";
	 }

	$query = $query . ";";
	$results = $mysqli->query($query);
	if(!$results){
		echo $mysqli->error;
		exit();
	}
	$mysqli->close();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>DVD Search Results</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="search_form.php">Search</a></li>
		<li class="breadcrumb-item active">Results</li>
	</ol>
	<div class="container-fluid">
		<div class="row">
			<h1 class="col-12 mt-4">DVD Search Results</h1>
		</div> <!-- .row -->
	</div> <!-- .container-fluid -->
	<div class="container-fluid">
		<div class="row mb-4">
			<div class="col-12 mt-4">
				<a href="search_form.php" role="button" class="btn btn-primary">Back to Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row">
			<div class="col-12">

				Showing 
				<?php echo $results->num_rows;
				?>
				result(s).

			</div> <!-- .col -->
			<div class="col-12">
				<table class="table table-hover table-responsive mt-4">
					<thead>
						<tr>
							<th>DVD Title</th>
							<th>Release Date</th>
							<th>Genre</th>
							<th>Rating</th>
						</tr>
					</thead>
					<tbody>


						<?php while($row = $results->fetch_assoc()):?>
							<tr>
								<td>
									<?php echo $row["title"]; ?>
								</td>
								<td><?php echo $row["release_date"]; ?></td>
								<td><?php echo $row["genre"]; ?></td>
								<td><?php echo $row["rating"]; ?></td>
							</tr>
						<?php endwhile;?>

					</tbody>
				</table>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="search_form.php" role="button" class="btn btn-primary">Back to Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container-fluid -->
</body>
</html>