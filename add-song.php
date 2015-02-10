<?php
		require_once __DIR__ . '/vendor/autoload.php';
		
		use \Itp\Music\ArtistQuery;
		use \Itp\Music\GenreQuery;
		use \Itp\Music\Song;
		use \Symfony\Component\HttpFoundation\Session\Session;

		$session = new \Symfony\Component\HttpFoundation\Session\Session();
		$session->start();

		$artistQuery = new ArtistQuery();
		$genreQuery = new GenreQuery();

		$artists = $artistQuery->getAll();
		$genres  = $genreQuery->getAll();

		if (isset($_POST['title'])) {
			
			$song = new Song();
			$song->setTitle($_POST['title']);
			$song->setArtistID($_POST['artist_id']);
			$song->setGenreID($_POST['genre_id']);
			$song->setPrice($_POST['price']);
			$song->save();

			$session->getFlashBag()->add('insert-success', "The song " . $song->getTitle() . " was inserted successfully, with an ID of " . $song->getId());

			header('Location: add-song.php');
			exit;

		}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Add a Song</title>
</head>
<body>

			<form method="post">
				<label>Title</label>
				<input type="text" name="title" placeholder="Song Title">
				<br>

				<label>Artist</label>
				<select name="artist_id">

					<?php foreach ($artists as $artist): ?>

						<option value="<?php echo $artist->id ?>">
							<?php echo $artist->artist_name ?>
						</option>

					<?php endforeach; ?>

				</select>
				<br>

				<label>Genre</label>
				<select name="genre_id">
					<?php foreach ($genres as $genre): ?>
						
						<option value="<?php echo $genre->id ?>">
							<?php echo $genre->genre ?>	
						</option>

					<?php endforeach; ?>

				</select>
				<br>

				<label>Price</label>
				<input type="number" name="price" placeholder="Price of Song" value="0">
				<br>

				<input type="submit">
			</form>

<!-- 	<?php


		if (isset($_POST['title'])):
			
			$song = new Song();
			$song->setTitle($_POST['title']);
			$song->setArtistID($_POST['artist_id']);
			$song->setGenreID($_POST['genre_id']);
			$song->setPrice($_POST['price']);
			$song->save();

			$session->getFlashBag()->add('insert-success', "The song " . $song->getTitle() . " was inserted successfully, with an ID of " . $song->getId());

			header('Location: add-song.php');
			exit;



	?>
	<?php endif; ?> -->

	<?php foreach ($session->getFlashBag()->get('insert-success') as $message): ?>
		<p>
			<?php echo $message ?>
		</p>
	<?php endforeach; ?>


</body>
</html>