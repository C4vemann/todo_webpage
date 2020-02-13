<?PHP
	
	include('dbc.php');

	$messages = ["Up early aren't we Anthony","Good Morning Anthony","Good Afternoon Anthony","Good Evening Anthony","Welcome Anthony"];
	
	$date = findDate($conn);
	$time = findTime($conn);
	$hour = findHour($conn, $time);
	$welcome = findWelcome($hour, $messages);


	$dateTimeDate = array(
		"date"=>$date,
		"time"=>$time,
		"welcome"=>$welcome
	);

	echo json_encode($dateTimeDate);

	function findHour($connection, $t){
		$stmt = mysqli_stmt_init($connection);
		$sqlQuery = "SELECT hour('$t');";
		mysqli_stmt_prepare($stmt, $sqlQuery);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $hour);
		mysqli_stmt_fetch($stmt);

		return $hour;
	}
	function findDate($connection){
		$stmt = mysqli_stmt_init($connection);
		$sqlQuery = "SELECT current_date();";

		mysqli_stmt_prepare($stmt, $sqlQuery);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $date);
		mysqli_stmt_fetch($stmt);
		return $date;
	}

	function findTime($connection){
		$stmt = mysqli_stmt_init($connection);
		$sqlQuery = "SELECT current_time();";

		mysqli_stmt_prepare($stmt, $sqlQuery);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $time);
		mysqli_stmt_fetch($stmt);
		return $time;
	}

	function findWelcome($h, $m){
		if($h <= 5){
			$message = $m[0];
		} else if($h > 5 && $h < 11){
			$message = $m[1];
		} else if($h > 11 && $h < 17){
			$message = $m[2];
		} else if($h >= 17){
			$message = $m[3];
		} else{
			$message = $m[4];
		}

		return $message;
	}