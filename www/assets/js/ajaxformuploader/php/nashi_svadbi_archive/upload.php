<?php

function UnzipImgArchive($archivPath, $unzipImgTo){

//$currentPath = dirname(__FILE__);
//$archivPath = $currentPath."/photo.zip"; // Путь к архиву
$unzipPath = $unzipImgTo; // Путь распоковки (отдельная папка для каждой записи блога)


	$zip = new ZipArchive;
	if ($zip->open($archivPath) === true)
	{
		//Если папка уже существует - очистить её или создать - если не сущ.
		if(is_dir($unzipPath))
			ForeachFromAllFiles($unzipPath, "clearDir");
		else
			mkdir($unzipPath,0777);

		$zip->extractTo($unzipPath);
		$zip->close();

		return ForeachFromAllFiles($unzipPath);
	}
	else
		return array("code" => 1, "text" => "Не могу найти файл архива!");

}

//Проход по всем распаковынным файлам, возвращает количество картинок!
function ForeachFromAllFiles($unzipPath, $mode = "imgFilter")
{
	if($mode == "imgFilter")
	{
			if ($handle = opendir($unzipPath)) {
			    $count = 0;
				$urls = "";
			    while (false !== ($file = readdir($handle))) 
			    { 
			    	if($file !="." && $file !="..")
			    	{
						RenameOrDeleteFile($file, $count, $unzipPath, $urls);
			    	}
			    }
			    closedir($handle); 
			    return array("code" => 0, 
								"countimg" => $count, 
								"imgurls" => $urls,
							);
			}
			else
				return array("code" => 2, "text" => "Не удалось открыть каталог: ".$unzipPath);
	}
	elseif($mode == "clearDir")
	{
			if ($handle = opendir($unzipPath)) {
			    while (false !== ($file = readdir($handle))) 
			    { 
			    	if($file !="." && $file !="..")
			    	{
			    		$fileName  = $unzipPath.$file;
			    		if(!is_dir($fileName))
				    		unlink($fileName);
				    }
			    }
			    closedir($handle); 
			}
			else
				return array("code" => 3, "text" => "Не удалось открыть каталог: ".$unzipPath);
	}
}

//Переименование картинок или удаление других файлов
function RenameOrDeleteFile($file, &$count, $path, &$urls){
	$path_info = pathinfo($file);
	$ext = strtolower($path_info['extension']);
	$oldName = $path."/".$file;

	$subject = "abcdef"; 
 	$pattern = '/^gif|jepeg|jpg|png|bmp/'; //Допустимые форматы изображений 

	if(preg_match($pattern, $ext))//Проверка расширения
	{
		$count++;
		$newName = $path.$count.".".$ext;
		rename($oldName, $newName);
		
		//Выдрать часть после 'assets'
		$pos = strpos($newName, "assets");
		$url = substr($newName, $pos);
		$urls .= $url.";";
	}
	else{
		if(!is_dir($oldName))
			unlink($oldName);
	}
		
}

