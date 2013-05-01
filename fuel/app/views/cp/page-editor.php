<script type="text/javascript">
//$(document).ready(function(){
		tinymce.init({
	    selector: "textarea",
	    theme: "modern",
		language : 'ru',
	    plugins: [
	        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
	        "searchreplace visualblocks visualchars code fullscreen",
	        "insertdatetime media nonbreaking save table contextmenu directionality",
	        "emoticons textcolor paste"
	    ],
	    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | 						bullist numlist outdent indent | link image",
	    toolbar2: "preview media | forecolor backcolor emoticons",
	});
//});
</script>

<?
$url = Uri::base(false)."cp/page/add/";
?>

<h4>Добавление новой страницы</h4>
<form name="page-editor" action="<?=$url;?>">
	<label for="editor-uri">Адрес страницы "/page/<b>адрес</b>", доступные символы (<b>A-Za-z-_0-9</b>):<br/>
	<small><i>Примечание: пробелы автоматически заменятся на "_"</i></small></label>
	<input id="editor-uri" style="width:645px;" type="text">
	<br/>
	
	<label class="checkbox">
      <input id="display-page-in-menu" type="checkbox" checked> Показывать ссылку на страницу в блоке меню
    </label>
	
	<label for="editor-link-text">Текст ссылки:</label>
	<input id="editor-link-text" style="width:645px;" type="text" >
	<br/>
	<label for="editor-title">Заголовок окна браузера:</label>
	<input id="editor-title" style="width:645px;" type="text" >
	<br/>
	<label for="editor-content-title">Заголовок на странице (<b>может отсутствовать</b>):</label>
	<input id="editor-content-title" style="width:645px;" type="text">
	<br/>
	<label>Содержание:</label>
    <textarea id="editor-content" style="height:300px; width:620px;"></textarea>
	<br/>
	
	<div>
		<div style="float:left;"> 
		<input id="editor-send-btn"  class="btn btn-success" type="button" value="Сохранить"/>
		</div>
		<div class="ajax-loading" id="page-editor-ajax" style="float:left; margin:7px 0px 0px 10px;"></div>
		<div class="clear"></div>
	</div>
</form>