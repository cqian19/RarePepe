<?php
	require_once('config.php');
	$db =  $config['db'];
	$error = "";
	function uploadImage(){
		global $error;
		if(isset($_POST['submit'])){
			$filename = $_FILES['image']['tmp_name'];
			if ($filename){
				$check = getimagesize($_FILES['image']['tmp_name']);
				if($check){
					//Image can be no larger than 500 kb.
					if($_FILES['image']['size'] < 500000){
						$image = addslashes($_FILES['image']['tmp_name']);
						$name = addslashes($_FILES['image']['name']);
						$image = file_get_contents($image);
						$image = base64_encode($image);
						saveImage($name,$image);
					}
					else{
						$error = "<br>Pepe too large! Size:".$_FILES['image']['size'];
					}
				}
				
			}
			else {
				$error = "<br>No pepe selected.";
			}
		}
	} 

	function saveImage($name,$image){
		global $error;
		$conn = mysqli_connect($db['host'], $db['user'], $db['password']);
		mysqli_select_db($conn, 'pepe');
		$stmt = mysqli_prepare($conn, "INSERT INTO pepe(name,image) VALUES(?,?)");
		mysqli_stmt_bind_param($stmt, "ss", $name, $image);
		$success = mysqli_stmt_execute($stmt);
		if (! $success){
			$error = "<br>Upload failed! " . mysqli_error($conn);
		}
	}

	function createImageTable($conn){
		mysqli_select_db($conn, 'pepe');
		$sql = "
		CREATE TABLE IF NOT EXISTS pepe(
			name LONGTEXT,
			image LONGTEXT
		);
		";
		mysqli_query($conn, $sql);
	}

	function displayImages(){
		global $db;
		$conn = mysqli_connect($db['host'], $db['user'], $db['password']);
		if (!$conn){
			die("server connection failed");
		}
		mysqli_select_db($conn, 'pepe');
		createImageTable($conn);
		$qry = "SELECT * FROM pepe LIMIT 25";
		$result = mysqli_query($conn, $qry);
		while($row = mysqli_fetch_array($result)){
			$data = $row["image"];
			if ($data){	
				echo '<div class="col-md-3">
						<div class="thumbnail">
							<img width="200" height="200" class="pepeimage" oncontextmenu="return false;" src="data:image/gif;base64,' . $data . '" />
					  	</div>
					  </div>';
			}
		}
		mysqli_close($conn);
	}
?>