<?
$settings = json_decode($_POST["ajaxFormUploaderSettings"], true); // Преобразование JSON строки в ассоциативный массив
$varName = $settings["varName"];
//Обработка запроса

//Имя папки для конкретной записи в блоге
$dir_name = $_POST["goods_dir_name"];

//Корневая папка приложения
$rootPath = $_SERVER['DOCUMENT_ROOT'];

//Распоковать картинки в 
$unzipImgTo = $rootPath.'/assets/upload/goods/'.$dir_name."/";




$downloadedPhotoCount = 0;
$fileCount = count($_FILES["goods_photo"]["name"]);
if($fileCount >= 1)
{
	require_once "helpfunc.php";
	CheckAndClearDir($unzipImgTo);

	for($i = 0; $i < $fileCount; $i++)
	{
	    if($_FILES["goods_photo"]["error"][$i] == 0 && $_FILES["goods_photo"]["size"][$i] > 0)
	    {
	    	//Берем разширение
	    	$path_info = pathinfo(basename($_FILES["goods_photo"]['name'][$i]));
			$archExt = strtolower($path_info['extension']);
			
			//Проверка расширения
			if($archExt == "jpg" || $archExt == "jepeg" || $archExt == "png" || $archExt == "gif" || $archExt == "bmp")
			{
				//TODO: Удаление существующих фотографий в папке
				//Загрузка файла
				$newName = $downloadedPhotoCount+1;
		        if(move_uploaded_file($_FILES["goods_photo"]['tmp_name'][$i], $unzipImgTo.$newName.".".$archExt)){
		        	$downloadedPhotoCount++;
		        	$photoNames .= $newName.".".$archExt.";";
		        }
		        	
		    }
	    }

	}
}

$answer = array("code" => 0, "text" => "Загружено", 
	"totalPhoto" => $fileCount, 
	"downloadedPhoto" => $downloadedPhotoCount,
	"photoNames" => $photoNames
	);

//Обработка запроса//
echo"<script type='text/javascript'>";
echo "window.top.window.".$varName.".callback(".json_encode($answer).");";
echo "</script>";
?>