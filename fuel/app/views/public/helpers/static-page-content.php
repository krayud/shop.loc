<script>
tinyMCE.execCommand("mceAddControl", true, "fastEditContent");
</script>

<div style="text-align: right;">
<a href="#" id="fast-edit-btn">Быстрое редактирование</a> | 
<a href="<?=Uri::base(false)."cp/page/edit/".$id;?>" id="fast-edit-btn">Полный редактор</a>
</div>
<? 
if($content_title != null)
	echo "<div class='page-content-title'>".$content_title."</div>";
?>

<div id="cms-content-editor" style="display: none;">
<form id="fastEditForm" action="<?=Uri::base(false)?>cp/page/updatecontent">
	<input id="fastEditPageId" type="hidden" value="<?=$id;?>"/>
	<textarea id="fastEditContent"><?=$content;?></textarea>
	<input id="fastSaveBtn" type="button" value="Сохранить" />
	<span id="fast-editor-ajax" style="display:none;"> Загрузка...</span>
</form>
</div>

<div id="cms-content-div">
	<?=$content;?>
</div>
