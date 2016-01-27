<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="stylesheet.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script type="text/javascript" src="https://cdn.jsdelivr.net/bootstrap.filestyle/1.1.0/js/bootstrap-filestyle.min.js"> </script>
		<script type="text/javascript" src="index.js"></script>
		<?php include "upload.php"; ?>
	</head>

	<body>
		<div class="buttonHolder">
			<h1 class ="title">Rare Pepe</h1>
			<form name="filesubmit" method="post" enctype="multipart/form-data" action="<?php uploadImage() ?>">
				<p name = "Error"><b><?php echo $error ?></b></p>
				<input type="file" name="image" class="filestyle" accept="image/*" onchange="previewImage(event)" data-buttonText="Choose Pepe" data-input="false" data-iconName="glyphicon glyphicon-star-empty">
				<br>
				<button type="submit" name="submit" class="btn btn-success">Submit Pepe</button>
			</form>
			<br>
			<img id="preview"></img>
		</div>
		<div class="container-title"><h2>Rare pepe gallery</h2></div>
		<div name="container" class="container">
			<?php displayImages(); ?>
		</div>
	</body>
</html>