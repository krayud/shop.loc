<?
$settings = json_decode($_POST["ajaxFormUploaderSettings"], true); // Преобразование JSON строки в ассоциативный массив
$varName = $settings["varName"];
//Обработка запроса

//Имя папки для конкретной записи в блоге
$dir_name = $_POST["article_dir_name"];

//Корневая папка приложения
$rootPath = $_SERVER['DOCUMENT_ROOT'];

//Загрузить архив в
$upLoadArchTo = $rootPath.'/assets/upload/tmp/';
//Распоковать картинки в 
$unzipImgTo = $rootPath.'/assets/upload/nashi_svadbi/'.$dir_name."/";

$path_info = pathinfo(basename($_FILES['archive']['name']));
$archExt = $path_info['extension'];
//Новый путь к архиву после смены имени
$archPath = $upLoadArchTo."archive.".$archExt;
//Проверка расширения архива
if($archExt == "zip" || $archExt == "ZIP" )
{
	if (move_uploaded_file($_FILES['archive']['tmp_name'], $archPath)){
		//Распаковка архива с изображениями...
		require_once("upload.php");
		$answer = UnzipImgArchive($archPath, $unzipImgTo);

		//Удаление архива
		if(file_exists($archPath))
			unlink($archPath);
	}
	else
		$answer = array("code" => 1, "text" => "Ошибка при загрузке файла 'move_uploaded_file'");
}
else
	$answer = array("code" => 4, "text" => "Некорректный файл. Архив должен быть в формате '.zip'");

//Обработка запроса//
echo"<script type='text/javascript'>";
echo "window.top.window.".$varName.".callback(".json_encode($answer).");";
echo "</script>";
?>