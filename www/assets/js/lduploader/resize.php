<?php
header('Content-Type: text/html; charset=utf-8');

function resizeImg($from, $to, $targetW, $targetH){
	$standatrW = $targetW;
	$standatrH = $targetH;
	$originalPic = $from;
	$saveFile = $to;

	if(!file_exists($originalPic))
		return "Файл не найден";

	$pathInfo = pathinfo($from); 
	$ext = strtolower($pathInfo['extension']);

	//Определяем размер фотографии — ширину и высоту
	$size=GetImageSize ($originalPic);
	//Берём числовое значение ширины фотографии, которое мы получили в первой строке и записываем это число в переменную
	$iw=$size[0];
	//Проделываем ту же операцию, что и в предыдущей строке, но только уже с высотой.
	$ih=$size[1];


	//Если картинка меньше нужных размеров - тут нечего ловить =)
	if($iw > $standatrW || $ih > $standatrH)
	{
		//Создаём новое изображение из «старого»
		switch($ext){
			case "jpg":
				$src=ImageCreateFromJPEG ($originalPic);
			break;
			case "jpeg":
				$src=ImageCreateFromJPEG ($originalPic);
				break;
			case "png":
				$src=imagecreatefrompng($originalPic);
				break;
			case "gif":
				$src=imagecreatefromgif($originalPic);
				break;
			default:
				return "Некорректный формат файла";
			break;
		}
		//Создаём пустой изображени шириной в 150 пикселей и высотой, которую мы вычислили в предыдущей строке.

		$boxW = $standatrW;
		$boxH = $standatrH;
		 
		if($iw < $standatrW)
			$boxW = $iw;
		if($ih < $standatrH)
			$boxH = $ih;
		$dst=ImageCreateTrueColor ($boxW, $boxH);

		// Если картинка больше по ширине и по высоте
		if($iw > $standatrW && $ih > $standatrH){
			//Ширину фотографии делим на $standatrW т.к. на выходе мы хотим получить фото шириной в $standatrW пикселей. В результате получаем коэфициент соотношения ширины оригинала с будущей превьюшкой.
			$koe=$iw/$standatrW;

			//Находим новую высоту
			$new_h=ceil($ih/$koe);
				
			//Если высота получилась меньше $standatrH - ширину оригинала и вырезаем из него картинку размерами $standatrWх$standatrH
			if($new_h < $standatrH){
				$newKoef = $standatrH / $new_h;
				//Нужная ширина для такой высоты
				$w = ceil($standatrW * $newKoef);
				//Сместить влево для вырезания центра картинки
				$marginLeft = ($w - $standatrW)/2;
				imagecopyresampled($dst, $src, -1*($marginLeft), 0, 0, 0, $w, $standatrH, $iw, $ih);
			}
			else{
				$marginTop = ($new_h - $standatrH) / 2;
				imagecopyresampled($dst, $src, 0, 0, 0, $marginTop, $standatrW, $new_h, $iw, $ih);
			}

		}//Если только ширина больше
		elseif($iw > $standatrW){
			//Сместить влево для вырезания центра картинки
			$marginLeft = ($iw - $standatrW) / 2;
			imagecopyresampled($dst, $src, 0, 0, $marginLeft, 0, $standatrW, $ih, $standatrW, $ih);

		}//Если только высота больше
		elseif($ih > $standatrH){
			//Сместить вниз для вырезания центра картинки
			$marginTop = ($ih - $standatrH) / 2;
			imagecopyresampled($dst, $src, 0, 0, 0, $marginTop, $iw, $standatrH, $iw, $standatrH);
		}

		//Сохраняем полученное изображение в формате JPG
		switch($ext){
			case "jpg":
				ImageJPEG ($dst, $saveFile, 100);
				break;
			case "jpeg":
				ImageJPEG ($dst, $saveFile, 100);
				break;
			case "png":
				imagepng($dst, $saveFile);
				break;
			case "gif":
				imagegif($dst, $saveFile);
				break;
			default:
				return "Некорректный формат файла";
				break;
		}
		imagedestroy($src);
		return 0;
	}
	return 0;
}

//resizeImg("1.jpg", "pic_mini.jpg", "300", "200");
?>