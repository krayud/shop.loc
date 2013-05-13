Установка:
1. Подключить библиотеку Jquery
2. В header разместить:
<script>
$(document).ready(function(){

        LDUploader.init({
                form : "#upForm", //Селектор формы, к которой привязывается скрипт
                inputName : "userfile", //Имя поля с файлом
                resize : "300, 200", // Авторесайз: false - отключить или размеры в формате 'x, y'
                uploaderPath : "/assets/js/lduploader/", //Путь к корневойпапке загрузчика 'lduploader' относительно хоста сайта(http://site.ru + uploaderPath)
                extensions : "jpg, gif, png", //Допустимые расширения файлов
                charsetToSave : "windows-1251", //Кодировка, в которой будет сохранён файл
                normalInputStyle : "false", // Нормализовать стиль инпута файла для всех браузеров (true/false)
                realName : "false", // Использовать реальное имя файла = true, сгенерировать имя (ф-я time()) = false
                defaultName : "<?=time();?>", //Сохранить файл с этим именем. Работает или realName или defaultName!!!
                uploadPath : "/assets/upload/blog/", // Каталог загрузки (Относительно корня сайта! '/' в конце обязателен!)
                before : function(){
                    //Перез загрузкой
                },
                callback : function(answer){
                    //Конец загрузки            
                       alert(answer.text);
                },
            });
});
</script>
3. Настроить параметры инициализации
4. В телеф документа добавить 

<form id="upForm">
	<input name="userfile" type="file"><br/>
	<input type="submit" value="Загрузить" />
</form>