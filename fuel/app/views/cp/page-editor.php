<script type="text/javascript">

tinyMCE.init({
        // General options
        mode : "textareas",
        theme : "advanced",
		language : 'ru',
		file_browser_callback: "filebrowser",
		
        plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

        // Theme options
        theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,

        // Skin options
        skin : "o2k7",
        //skin_variant : "silver",

        // Example content CSS (should be your site CSS)
        content_css : "/assets/css/public/7431cbeb.css",
});

function filebrowser(field_name, url, type, win) {
		
	fileBrowserURL = "/assets/js/tiny_mce/plugins/pdw_file_browser/index.php?filter=" + type;
			
	tinyMCE.activeEditor.windowManager.open({
		title: "Файловый менеджер",
		url: fileBrowserURL,
		width: 950,
		height: 650,
		inline: 0,
		maximizable: 1,
		close_previous: 0
	},{
		window : win,
		input : field_name
	});		
}

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