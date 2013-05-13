<script>
tinyMCE.execCommand("mceAddControl", true, "article-text");

$(document).ready(function(){
    LDUploader.init({
            form : "#upForm",
            inputName : "userfile",
            uploaderPath : "/assets/js/lduploader/",
            extensions : "jpg, gif, png", 
            charsetToSave : "windows-1251",
			resize : "300, 200",
            normalInputStyle : "false",
            realName : "false",
            defaultName : "<?=time();?>",
			uploadPath : "/assets/upload/blog/",
            before : function(){
                //Перез загрузкой
				$("#img-loading-ajax").addClass("ajax-loading-visible");
            },
            callback : function(answer){
                //Конец загрузки            
                if(answer.code == 0)
                    SetMiniSrc(answer.fileInfo.src);
                else
                    alert(answer.text);
				$("#img-loading-ajax").removeClass("ajax-loading-visible");
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

				<div style="float:left;"> 
					 <input type="submit" value="Загрузить" />
				</div>
				<div id="img-loading-ajax" class="ajax-loading"></div>
				<div class="clear"></div>
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