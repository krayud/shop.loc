//Установка:
//JAVASCRIPT
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="...загрузчик/lduploader.js"></script>
<script>
LDUploader.init({
		form : "#upForm", //Форма, к которой привязывается скрипт
		inputName : "userfile", //Имя поля с файлом
		charsetToSave : "windows-1251", //Кодировка, в которой будет сохранён файл
		realName : "true", // Использовать реальное имя файла = true, сгенерировать имя (ф-я time()) = false
		uploadPath : "...загрузчик/upload/", // Каталог загрузки (Относительно корня сайта! '/' в конце обязателен!)
		before : function(){
			//Перез загрузкой
		},
		callback : function(answer){
			//Конец загрузки
			//alert(answer.fileInfo.fullName+"|"+answer.fileInfo.name+"|"+answer.fileInfo.ext+"|"+answer.fileInfo.src);
		},
	});
</script>

//HTML
<form id="upForm">
    <input name="userfile" type="file"><br/>
    <input type="submit" value="Загрузить" />
</form>