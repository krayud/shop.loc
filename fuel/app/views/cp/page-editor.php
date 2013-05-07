<script>
tinyMCE.execCommand("mceAddControl", true, "editor-content");
</script>
<?
if(isset($pageInfo)){// если страница редактируется
	$url = Uri::base(false)."cp/page/update/";
	$editPageId = $pageInfo['id'];
	echo "<h4>Редактирование страницы</h4>";
}
else{// если добавляется новая страница
	$url = Uri::base(false)."cp/page/add/";
	$editPageId = null;
	echo "<h4>Добавление новой страницы</h4>";
	$pageInfo = null;
}
?>
<form name="page-editor" action="<?=$url;?>">
	<input id="editPageId" type="hidden" value="<?=$editPageId;?>"/>
	<label for="editor-uri">Адрес страницы "/page/<b>адрес</b>", доступные символы (<b>A-Za-z-_0-9</b>):<br/>
	<small><i>Примечание: пробелы автоматически заменятся на "_"</i></small></label>
	<input id="editor-uri" style="width:645px;" type="text" value="<?=$pageInfo['uri'];?>">
	<br/>
	
	<label class="checkbox">
      <input id="display-page-in-menu" type="checkbox" <? if($pageInfo['display_link'] == 1 || $pageInfo === null) echo "checked";?>> Показывать ссылку на страницу в блоке меню
    </label>
	
	<label for="editor-link-text">Текст ссылки:</label>
	<input id="editor-link-text" style="width:645px;" type="text"
	<? if($pageInfo['display_link'] == 0 && $pageInfo !=null) echo "disabled";?> value="<?=$pageInfo['link_text'];?>">
	<br/>
	<label for="editor-title">Заголовок окна браузера:</label>
	<input id="editor-title" style="width:645px;" type="text" value="<?=$pageInfo['title'];?>">
	<br/>
	<label for="editor-content-title">Заголовок на странице (<b>может отсутствовать</b>):</label>
	<input id="editor-content-title" style="width:645px;" type="text" value="<?=$pageInfo['content_title'];?>">
	<br/>
	<label>Содержание:</label>
    <textarea id="editor-content" style="height:300px; width:620px;"><?=$pageInfo['content'];?></textarea>
	<br/>
	
	<div>
		<div style="float:left;"> 
		<input id="editor-send-btn"  class="btn btn-success" type="button" value="Сохранить"/>
		</div>
		<div class="ajax-loading" id="page-editor-ajax" style="float:left; margin:7px 0px 0px 10px;"></div>
		<div class="clear"></div>
	</div>
</form>