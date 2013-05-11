<script>
tinyMCE.execCommand("mceAddControl", true, "article-text");


$(document).ready(function(){
	LDUploader.init({
		form : "#upForm", //Форма, к которой привязывается скрипт
		inputName : "userfile", //Имя поля с файлом
		action : "/assets/js/lduploader/upload.php",
		extensions : "jpg, gif, png", //Допустимые расширения файлов
		charsetToSave : "windows-1251", //Кодировка, в которой будет сохранён файл
		realName : "false", // Использовать реальное имя файла = true, сгенерировать имя (ф-я time()) = false
		defaultName : "<?=time();?>", //Сохранить файл с этим именем. Работает или realName или defaultName!!!
		uploadPath : "/assets/upload/blog/", // Каталог загрузки (Относительно корня сайта! '/' в конце обязателен!)
		before : function(){
			//Перез загрузкой
		},
		callback : function(answer){
			//Конец загрузки			
			if(answer.code == 0)
				SetMiniSrc(answer.fileInfo.src);
			else
				alert(answer.text);
		},
	});
	
function SetMiniSrc(src){
	$(".article-mini-img, .article-big-img").attr("src",src);
	$("#big-img-src").val(src);
}
});
</script>

<?
if(isset($articleInfo)){// если запись редактируется
	$url = Uri::base(false)."cp/blog/update/";
	$editArticleId = $articleInfo['id'];
	echo "<h4>Редактирование страницы</h4>";
}
else{// если добавляется новая запись
	$url = Uri::base(false)."cp/blog/add/";
	$editArticleId = null;
	echo "<h4>Добавление записи в блог</h4>";
	$articleInfo = null;
}
?>

<div>
	<label>Миниатюры:</label>
		<div id="left-div">
			<?=Asset::img("cp/empty_mini_small.gif", array('class' => 'article-mini-img'));?><br/>
			<form id="upForm">
			    <input name="userfile" size="1" type="file"><br/>
			    <input type="submit" value="Загрузить" />
			</form>
		</div>
		<div id="right-div">
			<input id="big-img-src" value="none" type="hidden"/>
			<?=Asset::img("cp/empty_mini_big.gif", array('class' => 'article-big-img'));?><br/>
		</div>
		<div class="clear"></div>
	</div>
	<br/>
<form name="article-editor"  action="<?=$url;?>">
	<input id="editArticleId" type="hidden" value="<?=$editArticleId;?>"/>
	<label>Раздел:</label>
	<select id="blog-section">
		<option value='0'></option>
	 <?foreach($blogSections as $section) 
	 		printf("<option value='%s'>%s</option>", $section[0],$section[1]);
	 ?>
	</select>
	<input id='ajaxCatLoadUrl' type='hidden' value='<?=Uri::base(false);?>cp/blog/ajaxGetCatList'/>
	<br/>
	
	<label>Категория:</label>
	<select id="blog-category">
	 	<option value='0'></option>
	</select>
	
	<label class="checkbox">
      <input id="display-in-mini-block" type="checkbox" <? if($articleInfo['display_in_mini_block'] == 1 || $articleInfo === null) echo "checked";?>> Отображать в мини блоке
    </label>
	
	<label for="article-title">Заголовок:</label>
	<input id="article-title" type="text" value="<?=$articleInfo['title'];?>">
	<br/>
	
	<label>Краткое описание:</label>
	<textarea id="article-description"><?=$articleInfo['description'];?></textarea><br/>
		
	<label>Полное содержание:</label>
    <textarea id="article-text"><?=$articleInfo['content'];?></textarea>
	<br/>
	
	<div>
		<div style="float:left;"> 
		<input id="editor-send-btn"  class="btn btn-success" type="button" value="Сохранить"/>
		</div>
		<div class="ajax-loading" id="page-editor-ajax"></div>
		<div class="clear"></div>
	</div>
</form>