<?PHP

	include('dbc.php');

	$target = './_backgroundPictures/';
	
	$totalPictureCount = findCount($conn);

	$currentPictureName = mysqli_real_escape_string($conn, $_GET['picture']);
	

	$currentPictureId = findPicId($conn, $currentPictureName);

	$currentPictureId++;

	if($currentPictureId > $totalPictureCount){
		$currentPictureId = 1;
	}

	$newPictureName = acquireNewPicUrl($conn, $currentPictureId);
	$newPictureUrl = outputNewPicUrl($target, $newPictureName);

	$pictureData = array(
		"afterPicName"=>$newPictureName,
		"url"=>$newPictureUrl,
	);

	echo json_encode($pictureData);

	function outputNewPicUrl($target, $pic){
		$str = "url('" . $target . $pic . "')";
		return $str;
	}

	function acquireNewPicUrl($connection, $id){
		$stmt = mysqli_stmt_init($connection);
		$sqlQuery = "SELECT picture_url FROM bodyBackground WHERE picture_id = ?;";
		mysqli_stmt_prepare($stmt, $sqlQuery);
		mysqli_stmt_bind_param($stmt, 'i', $id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $picture_url);
		mysqli_stmt_fetch($stmt);
		return $picture_url;
	}

	function findCount($connection){
		$stmt = mysqli_stmt_init($connection);
		$sqlQuery = "SELECT COUNT(*) FROM bodyBackground";
		mysqli_stmt_prepare($stmt, $sqlQuery);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $amount);
		mysqli_stmt_fetch($stmt);
		return $amount;
	}

	function findPicId($connection, $cpn){
		$stmt = mysqli_stmt_init($connection);
		$sqlQuery = "SELECT picture_id FROM bodyBackground WHERE picture_url = ?;";
		mysqli_stmt_prepare($stmt, $sqlQuery);
		mysqli_stmt_bind_param($stmt, 's', $cpn);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $picture_id);
		mysqli_stmt_fetch($stmt);
		return $picture_id;
	}