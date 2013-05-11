 <?PHP

$settings = json_decode($_POST["settings"], true); // Преобразование JSON строки в ассоциативный массив

$realName = $settings["realName"]; // Использовать ли реальное имя файла
$inputName = $settings["inputName"]; // Имя поля с файлом
$charsetToSave = $settings["charsetToSave"]; // Кодировка, в которой нужно сохранить файл
$uploadPath = $settings["uploadPath"];
$defaultName = $settings["defaultName"];
$extensions = $settings["extensions"];

$uploaddir = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.$uploadPath; //Папка для загрузки

$pathInfo = pathinfo($_FILES[$inputName]['name']); 
$ext = $pathInfo['extension']; // Определение расширения файла
if(strstr($extensions, $ext))
{
	$basename = basename($pathInfo['basename'], ".".$ext); // Имя файла без разширения
	//Если имя уже задано по-умолчанию
	if($defaultName != "false")
	{
		$fileName = $defaultName.".".$ext;
		$src = $uploadPath.$fileName;
	}	
	else{
		//Использовать реальное имя файла или сгенерировать из времени
		if($realName == "true")
		{
			$fileName = $_FILES[$inputName]['name'];	// Имя файла для сохранения
			$src = $uploadPath.$fileName; 
			//Перекодирование (если нужно)
			if($charsetToSave != "UTF-8")
				$fileName = iconv("UTF-8", $charsetToSave, $fileName);
		}
		else
		{
			$fileName = time().".".$ext;
			$src = $uploadPath.$fileName;
		}
	}


	// Окончательный путь с именем файла 
	$fullPath = $uploaddir . DIRECTORY_SEPARATOR . $fileName; // Конечный полный путь



	if (move_uploaded_file($_FILES[$inputName]['tmp_name'], $fullPath))
			$answer = array("code" => 0, "text" => "Файл загружен", "fileInfo" => array(
				"name" => $basename,
				"ext" => $ext,
				"fullName" => $basename.'.'.$ext, 
				"src" => $src,
				)
			);
	else
			$answer = array("code" => 1, "text" => "Ошибка функции move_uploaded_file");
}
else
	$answer = array("code" => 2, "text" => "Некорректное расширение ('.".$ext."') файла");


echo "<script>window.top.LDUploader.callback(".json_encode($answer).");</script>";
?>