<?php

	// TODO: Establish DB connection, submit SQL query here. Remember to check for any MySQLi errors.
	$host = "303.itpwebdev.com";
	$user= "jersongu_db_itp";
	$password = "CECSLogitech2428";
	$db = "jersongu_football_schedule_db";

	$mysqli = new mysqli($host, $user, $password, $db);

	if($mysqli->connect_errno){
		echo $mysqli->connect_errno;
		exit();
	}
	$query = "SELECT date, days.day, team1.team AS home_team, team2.team AS away_team, venues.venue
		FROM schedule
		JOIN days
		ON days.id = schedule.day_id
		JOIN teams AS team1
		ON schedule.home_team_id = team1.id
		JOIN teams AS team2
		ON schedule.away_team_id = team2.id
		JOIN venues
		ON schedule.venue_id = venues.id;";
	$results = $mysqli->query($query);
	if ( $results == false ) {
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
	<title>Football Database Search Results</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<h1 class="col-12 mt-4">Football Schedule</h1>
		</div> <!-- .row -->
	</div> <!-- .container-fluid -->
	<div class="container-fluid">
		<div class="row mb-4">
			<div class="col-12 mt-4">
				<a href="index.php" role="button" class="btn btn-primary">Back to Home</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row">
			<div class="col-12">

				<!-- TODO: Replace '1' with actual number of results -->
				Showing 
				<?php
					echo $results->num_rows;
				?>
				 result(s).

			</div> <!-- .col -->
			<div class="col-12">
				<table class="table table-hover table-responsive mt-4">
					<thead>
						<tr>
							<th>Date</th>
							<th>Day</th>
							<th>Home Team</th>
							<th>Away Team</th>
							<th>Venue</th>
						</tr>
					</thead>
					<tbody>

						<!-- TODO: Loop through DB results and output them here. Modify or remove hard-coded <tr> below. -->
						<?php while($row = $results->fetch_assoc()):?>
							
							<tr>
								<td><?php 
									echo $row["date"];
								?>
								</td>
								<td><?php 
									echo $row["day"];
								?></td>
								<td><?php 
									echo $row["home_team"];
								?></td>
								<td><?php 
									echo $row["away_team"];
								?></td>
								<td><?php 
									echo $row["venue"];
								?></td>
							</tr>
						<?php endwhile;?>

					</tbody>
				</table>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="index.php" role="button" class="btn btn-primary">Back to Home</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container-fluid -->
</body>
</html>