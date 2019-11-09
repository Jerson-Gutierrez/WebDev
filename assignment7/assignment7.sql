/* Create a view football_schedule that displays the full
schedule in chronological order.Shows day, date, home
team, away team, and venue.*/

CREATE OR REPLACE VIEW football_schedule AS
SELECT day, schedule.date, teams1.team AS home, teams2.team AS away, venues.venue
FROM days
	JOIN schedule
    ON days.id = schedule.day_id
    JOIN teams as teams1
    ON schedule.home_team_id = teams1.id
    JOIN teams as teams2
    ON schedule.away_team_id = teams2.id
    JOIN venues
    ON schedule.venue_id = venues.id
ORDER BY schedule.date, schedule.away_team_id DESC; 

/*Insert Colorado Buffaloes vs UCLA bruins @ folsom field and 
Oregon state beavers vs Arizona state sun devils @ reser stadium */
-- Folsom field must be inserted into the venues table since it doesn't exist
INSERT INTO venues(venue)
VALUES('Folsom Field');

-- Insert the games with appropriate ids
INSERT INTO schedule(date, day_id, venue_id, away_team_id, home_team_id)
VALUES('2017-11-18', 7, 10, 4 ,10);
INSERT INTO schedule(date, day_id, venue_id, away_team_id, home_team_id)
VALUES('2017-11-18',7, 8, 6, 9);

-- update away team to usc trojans and date to 2017-11-11
UPDATE schedule
SET away_team_id = 1, date = '2017-11-11'
WHERE id = 20;

-- Delete OREGON vs ARIZONA on 2017-11-11
DELETE FROM schedule
WHERE id = 21;

-- Display all venues and number of times each venue is used 
-- in game_count column
SELECT venues.id,venues.venue, COUNT(*) as game_count
FROM venues
	JOIN schedule
		ON venues.id = schedule.venue_id
	GROUP BY venues.id;
    
/* ******************** Part 2 of assignment ********************  */

/*
Create a view dramas that displays all drama DVDs with release date not set to NULL. 
Show DVD ID, DVD title, release date, award, format, genre, label, rating, and sound.
*/
CREATE OR REPLACE VIEW drama AS
SELECT dvd_titles.dvd_title_id, dvd_titles.title, dvd_titles.release_date, 
dvd_titles.award, formats.format, genres.genre, labels.label, ratings.rating,
sounds.sound
FROM dvd_titles
	JOIN formats
		ON formats.format_id = dvd_titles.format_id
	JOIN genres
		ON genres.genre_id = dvd_titles.genre_id
	JOIN labels
		ON labels.label_id = dvd_titles.label_id
	JOIN ratings
		ON ratings.rating_id = dvd_titles.rating_id
	JOIN sounds
		ON sounds.sound_id = dvd_titles.sound_id
	WHERE dvd_titles.release_date IS NOT NULL
ORDER BY dvd_titles.title; 
/*
I first looked up the id for the row to delete to make sure Im deleting the correct one
SELECT * FROM dvd_titles
WHERE title LIKE '%Major%';
*/

INSERT INTO dvd_titles(title, release_date, award, format_id,genre_id, label_id, rating_id, sound_id )
VALUES ('The Godfather', '1972-03-24', '45th Academy Award for Best Picture',2,9,92,7,4);

/* update label to: Columbia TriStar, genre to: comedy, format to : Fullscreen*/
UPDATE dvd_titles
SET label_id = 24, genre_id = 7, format_id = 4
WHERE dvd_title_id = 5131;

-- Delete Major League : Back to the Minors
DELETE FROM dvd_titles
WHERE dvd_title_id = 5932;

/* Display number of characters for the longest and shortest title in 
in the database.
*/
SELECT MAX(char_length(title)) AS longest_title, MIN(char_length(title)) AS shortest_title
FROM dvd_titles;

/* 
Display all genres and number of DVDs belonging to each genre as dvd_count column.
Show genre ID, genre name, and DVD count
*/
SELECT genres.genre_id, genres.genre, COUNT(*) AS dvd_count
FROM genres
	JOIN dvd_titles
		ON genres.genre_id = dvd_titles.genre_id
	GROUP BY genres.genre_id;