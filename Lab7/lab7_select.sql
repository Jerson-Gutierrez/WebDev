/*Display albums that have the word "on" somewhere in the album title
Sort results in alphabetical order by album title
*/
SELECT * 
FROM albums
WHERE title LIKE '%on%'
ORDER BY title;

/*Same as above but only show album title and artist names
*/

SELECT title, artists.name 
FROM albums
JOIN artists
ON albums.artist_id = artists.artist_id
WHERE title LIKE '%on%'
ORDER BY title;

/*Display tracks that have "AAC Audio file format". Only show track name
composer, media type name and unit price columns
*/

SELECT tracks.name AS track_name, composer, media_types.name AS media_type, tracks.unit_price
FROM tracks
JOIN media_types
	ON media_types.media_type_id = tracks.media_type_id
WHERE media_types.name LIKE 'AAC%';

/*Display R&B/Soul and Jazz tracks that have a composer (not NULL).
Sort results in reverse-alphabetical order by track name. Only shows 
track ID, track name, composer, miliseconds, and genre name.
*/

SELECT tracks.track_id, tracks.name AS track_name, tracks.composer, tracks.milliseconds, genres.name AS genre_name
FROM tracks
JOIN genres
	ON tracks.genre_id = genres.genre_id 
    AND
	tracks.composer IS NOT NULL
WHERE genres.name LIKE '%R&B/SOUL%' 
OR
genres.name LIKE '%JAZZ%'
ORDER BY tracks.name DESC;

