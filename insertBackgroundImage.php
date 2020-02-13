<?PHP
	if(isset($_POST['submitBackgroundPictures'])){
		
		include('dbc.php');


		$count = count($_FILES['insertBackgroundPicture']['name']);
		$fileUrl;
		$fileTmp;
		$fileType;
		$fileName;
		$target = "./_backgroundPictures/";
		$header = "Location: ../index.php?";
		for($i = 0; $i < $count; $i++){

			$fileUrl = $_FILES['insertBackgroundPicture']['name'][$i];
			$fileTmp = $_FILES['insertBackgroundPicture']['tmp_name'][$i];
			$fileType = $_FILES['insertBackgroundPicture']['type'][$i];
			$fileName = pathinfo($fileUrl)['filename'];

			$fileUrl = str_replace(" ", "", $fileUrl);
			$fileTarget = $target . $fileUrl;

			if(checkExtension($fileType)){
				if(checkForCopyCat($conn, $fileUrl)){
					if(move_uploaded_file($fileTmp, $fileTarget)){
						if(insertBackgroundPicture($conn, $fileUrl, $fileName)){
							$header = $header . $fileName . lastInListOutput($i, $count, 1);
							continue;
						} else{
							$header = $header . $fileName . lastInListOutput($i, $count, 0);
							reverseUploadedFile($fileTarget);
							continue;
						}
					} else{
						$header = $header . $fileName . lastInListOutput($i, $count, 0);
						continue;
					}
				} else{
					$header = $header . $fileName . lastInListOutput($i, $count, 0);
					continue;
				}
			} else {
				$header = $header . $fileName . lastInListOutput($i, $count, 0);
				continue;
			}
		}

		header($header);
		exit();
	} else{
		header("Location: ../index.php?upload=failure");
		exit();
	}

	function lastInListOutput($index, $last, $status){
		if($status == 0){
			if($index != $last-1){
				return "=failure&";
			} else{
				return "=failure";
			}
		} else{
			if($index != $last-1){
				return "=success&";
			} else{
				return "=success";
			}
		}
	}

	function checkExtension($type){
		if($type == 'image/jpeg' || $type == 'image/png'){
			return true;
		} else{
			return false;
		}
	}

	function checkForCopyCat($connection, $url){
		$stmt = mysqli_stmt_init($connection);
		$sqlQuery = "SELECT picture_url FROM bodyBackground WHERE picture_url = ?;";

		if($stmt == true){
			if(mysqli_stmt_prepare($stmt, $sqlQuery) == true){
				if(mysqli_stmt_bind_param($stmt, 's', $url) == true){
					if(mysqli_stmt_execute($stmt) == true){
						$result = mysqli_stmt_store_result($stmt);
						$num = mysqli_stmt_num_rows($stmt);

						if($num < 1){
							return true;
						} else{
							return false;
						}
					} else{
						echo 'stmt execute not true';
						return false;
					}
				} else{
					echo 'bind param not true';
					return false;
				}
			} else{
				echo ' stmt prepare not true';
				return false;
			}
		} else{
			echo 'stmt not true';
			return false;
		}
	}

	function insertBackgroundPicture($connection, $url, $name){
		$stmt = mysqli_stmt_init($connection);
		$sqlQuery = "INSERT INTO bodyBackground(picture_name, picture_url) VALUES (?,?);";

		if($stmt){
			if(mysqli_stmt_prepare($stmt, $sqlQuery)){
				if(mysqli_stmt_bind_param($stmt, 'ss', $name, $url)){
					if(mysqli_stmt_execute($stmt)){
						return true;
					} else{
						return false;
					}
				} else{
					return false;
				}
			} else{
				return false;
			}
		} else{
			return false;
		}
	}

	function reverseUploadedFile($location){
		if(file_exists($location)){
			unlink($location);
			return;
		} else{
			return;
		}
	}