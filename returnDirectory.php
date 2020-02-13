<?PHP
	
/*	$dir = './';
	$dirArr;
	$dirCount = 0;
	$fileArr;
	$fileCount = 0;
	$files = scandir($dir);

	for($i = 2; $i < count($files); $i++){
		if(is_dir($dir.$files[$i])){
			$dirArr[$dirCount] = $files[$i];
			$dirCount++;
		} else{
			$fileArr[$fileCount] = $files[$i];
			$fileCount++;
		}
	}

	
	$data = array(
		"directories"=>$dirArr,
		"files"=>$fileArr
	);

	echo json_encode($data);*/
	$arr = [];

	for($i = 0; $i < 10; $i++){
		$arr[$i] = $i;
	}

	$arr2 = array($arr);

	$data = array(
		'name'=>'fruit list',
		'fruit'=>$arr2
	);

	echo json_encode($data);
