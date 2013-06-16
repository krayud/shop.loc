<script>
tinyMCE.execCommand("mceAddControl", true, "fastEditContent");
</script>

<div id="cms-content-editor" style="display: none;">
[	<a href="#" id="fast-edit-btn-cancel">Назад</a>
	<a href="#" id="fast-edit-save-btn">Сохранить</a>
	<a href="<?=Uri::base(false)."cp/page/edit/".$id;?>" id="fast-edit-btn">Полный редактор</a>
]
	<span id="fast-editor-ajax" style="display:none;"> Загрузка...</span>
	<form id="fastEditForm" action="<?=Uri::base(false)?>cp/page/updatecontent">
		<input id="fastEditPageId" type="hidden" value="<?=$id;?>"/>
		<textarea id="fastEditContent"></textarea>
	</form>
</div>

<div id="cms-content-div">
	<?=$content;?>
</div>
