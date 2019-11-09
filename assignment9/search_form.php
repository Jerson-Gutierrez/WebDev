<?php
	$host = "303.itpwebdev.com";
	$user = "jersongu_db_itp";
	$password = "CECSLogitech2428";
	$db = "jersongu_dvd_db";

	//Instance of mysqli class
	$mysqli = new mysqli($host, $user, $password, $db);

	//Check if there was an error connecting 
	if($mysqli->connect_errno){
		//echo out error message and exit program. There is no need to go on if there is no DB connection
		echo $mysqli->connect_errno;
		exit();
	}

	//query to get genre names from Database
	$genre = "SELECT * FROM genres;";
	$genre_result = $mysqli->query($genre);
	if(!$genre_result){
			echo $mysqli->error;
			exit();
	}
	//query to get ratings names from Database
	$rating = "SELECT * FROM ratings;";
	$rating_result = $mysqli->query($rating);
	if(!$rating_result){
			echo $mysqli->error;
			exit();
	}

	//query to get genre labels from Database
	$label = "SELECT * FROM labels;";
	$label_result = $mysqli->query($label);
	if(!$label_result){
			echo $mysqli->error;
			exit();
	}

	//query to get genre formats from Database
	$format = "SELECT * FROM formats;";
	$format_result = $mysqli->query($format);
	if(!$format_result){
			echo $mysqli->error;
			exit();
	}

	//query to get sounds names from Database
	$sound = "SELECT * FROM sounds;";
	$sound_result = $mysqli->query($sound);
	if(!$sound_result){
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
	<title>DVD Search Form</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<style>
		.form-check-label {
			padding-top: calc(.5rem - 1px * 2);
			padding-bottom: calc(.5rem - 1px * 2);
			margin-bottom: 0;
		}
	</style>
</head>
<body>
	<ol class="breadcrumb">
		<li class="breadcrumb-item active">Search</li>
	</ol>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4 mb-4">DVD Search Form</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<form action="search_results.php" method="GET">
			<div class="form-group row">
				<label for="title-id" class="col-sm-3 col-form-label text-sm-right">DVD Title:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="title-id" name="title">
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<label for="genre-id" class="col-sm-3 col-form-label text-sm-right">Genre:</label>
				<div class="col-sm-9">
					<select name="genre" id="genre-id" class="form-control">

						<option value="" selected>-- All --</option>

						<?php while($genre_row = $genre_result->fetch_assoc()) :?>
						<!-- Genre dropdown options -->
							<option value ="<?php echo $genre_row['genre_id'];?>">
								<?php echo $genre_row["genre"];?>
							</option>

						<?php endwhile ;?>
					</select>
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<label for="rating-id" class="col-sm-3 col-form-label text-sm-right">Rating:</label>
				<div class="col-sm-9">
					<select name="rating" id="rating-id" class="form-control">
						<option value="" selected>-- All --</option>

						<!-- Rating dropdown options-->
						<?php while($rating_row = $rating_result->fetch_assoc()):?>
							<option value = "<?php echo $rating_row['rating_id'];?>">
							<?php echo $rating_row["rating"]; ?>
							</option>
						<?php endwhile ;?>

					</select>
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<label for="label-id" class="col-sm-3 col-form-label text-sm-right">Label:</label>
				<div class="col-sm-9">
					<select name="label" id="label-id" class="form-control">
						<option value="" selected>-- All --</option>

						<!-- Label dropdown options -->
						<?php while($label_row = $label_result->fetch_assoc()):?>
							<option value = "<?php echo $label_row['label_id'];?>">
							<?php echo $label_row["label"];?>
							</option>

						<?php endwhile;?>
					</select>
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<label for="format-id" class="col-sm-3 col-form-label text-sm-right">Format:</label>
				<div class="col-sm-9">
					<select name="format" id="format-id" class="form-control">
						<option value="" selected>-- All --</option>

						<!-- Format dropdown options -->
						<?php while($format_row = $format_result->fetch_assoc()):?>
							<option value = "<?php echo $format_row['format_id'];?>">
							<?php echo $format_row["format"]; ?>
							</option>
						<?php endwhile;?>
					</select>
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<label for="sound-id" class="col-sm-3 col-form-label text-sm-right">Sound:</label>
				<div class="col-sm-9">
					<select name="sound" id="sound-id" class="form-control">
						<option value="" selected>-- All --</option>

						<!-- Sound dropdown options -->
						<?php while($sound_row = $sound_result->fetch_assoc()):?>

							<option value = "<?php echo $sound_row['sound_id'];?>">
							<?php echo $sound_row["sound"];?>
							</option>
						<?php endwhile; ?>
					</select>
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<label for="award-id" class="col-sm-3 col-form-label text-sm-right">Award:</label>
				<div class="col-sm-9">
					<div class="form-check form-check-inline">
						<label class="form-check-label">
							<input class="form-check-input mr-2" type="radio" name="award" id="inlineCheckbox3" value="any" checked>Any
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label">
							<input class="form-check-input mr-2" type="radio" name="award" id="inlineCheckbox1" value="yes">Yes
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label">
							<input class="form-check-input mr-2" type="radio" name="award" id="inlineCheckbox2" value="no">No
						</label>
					</div>
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<label for="date-id" class="col-sm-3 col-form-label text-sm-right">Release Date:</label>
				<div class="col-sm-9">
					<div class="row">
						<div class="col">
							<label class="form-check-label">
								From: 
								<input type="date" class="form-control mt-2" name="release_date_from">
							</label>
						</div> <!-- .col -->
						<div class="col">
							<label class="form-check-label">
								to: 
								<input type="date" class="form-control mt-2" name="release_date_to">
							</label>
						</div> <!-- .col -->
					</div> <!-- .row -->
				</div> <!-- .col -->
			</div> <!-- .form-group -->
			<div class="form-group row">
				<div class="col-sm-3"></div>
				<div class="col-sm-9 mt-2">
					<button type="submit" class="btn btn-primary">Search</button>
					<button type="reset" class="btn btn-light">Reset</button>
				</div>
			</div> <!-- .form-group -->
		</form>
	</div> <!-- .container -->
</body>
</html>