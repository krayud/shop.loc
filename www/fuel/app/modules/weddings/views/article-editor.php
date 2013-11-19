<script>
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

	$("#dialog-modal-load-archive").dialog({
	  autoOpen: false,
	  width: 450,
      modal: true
    });

	$("#editor-append-archive-btn").click(function(){
		$("#dialog-modal-load-archive").dialog("open");
	});

var baseUri = "<?=Uri::base(false);?>";	

	//Загрузчик архива с изображениями
	a = new ajaxFormUploader();
	a.init({
		vaName:"a",
		formId:"archiveform",
		action: "<?=Uri::base(false)?>"+"assets/js/ajaxformuploader/php/nashi_svadbi_archive/uploader.php",
		before: function(){
			//return false; // Отменяет отправку формы
		},
		callback: function(result){
			if(result.code == 0){
				var arr = result.imgurls.split(/;/);
				for(i = 0; i < arr.length -1; i++){
					v = $("#article-photos").val();
					$("#article-photos").val(v+baseUri+arr[i]+";\n");
				}
				$("#dialog-modal-load-archive").dialog("close");
			}
			else
				alert(result.text);
		}
	});

});
</script>

<?
$url = Uri::base(false)."cp/weddings/add_update/";

if(isset($articleInfo)){// если запись редактируется
    $articleInfo = $articleInfo[0];
	$editArticleId = $articleInfo['id'];
    $miniImg = Uri::base(false).$articleInfo['img'];
    $bigImg = Uri::base(false).$articleInfo['img'];
    $big_img_src = $articleInfo['img'];
	echo "<h4>Редактирование свадебного архива</h4>";
}
else{// если добавляется новая запись
    $articleInfo = null;
	$editArticleId = 0;
	echo "<h4>Добавление записи в свадебный архив</h4>";
    $big_img_src = "assets/img/cp/empty_mini_big.gif";
    $miniImg = Uri::base(false)."assets/img/cp/empty_mini_small.gif";
    $bigImg = Uri::base(false).$big_img_src;
}
?>

<div>
	<label>Миниатюры:</label>
		<div id="left-div">
             <img src=<?=$miniImg;?>  class="article-mini-img" /><br/>
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
			<input id="big-img-src" value="<?=$big_img_src;?>" type="hidden"/>
            <img src=<?=$bigImg;?>  class="article-big-img" /><br/>
		</div>
		<div class="clear"></div>
	</div>
<form name="article-editor"  action="<?=$url;?>">
<input id="editArticleId" type="hidden" value="<?=$editArticleId;?>"/>
	<label for="article-title">Заголовок:</label>
	<input id="article-title" type="text" value="<?=$articleInfo['title'];?>">
	<br/>
	
	<div id="content-nashi_svadby">
		<label>Ссылки на фотографии:</label>
		<p><i><strong>Примечание:</strong> 
		Ссылки на изображения должны быть разделены знаком '<strong>;</strong>' (точка с запятой)
		</i>
		</p>
		<textarea id="article-photos"><?=$articleInfo['photo']?></textarea><br/>
		<p><i>
			Вы также можете загрузить фотографии в архиве. Для этого создайте и загрузите <strong>.zip</strong> архив с фотографиями.<br/>
		<strong>Примечание:</strong> Архив не должен содержать вложенные папки.
		</i></p>
		<input id="editor-append-archive-btn"  class="btn btn-info" type="button" 
		value="Загрузить фотографии в .zip архиве"/><br/><br/>
			
		<label>Ссылки на видео:</label>
	    <textarea id="article-video"><?=$articleInfo['video']?></textarea>
		<br/>
		
		<label>Идентификатор отзыва:</label>
	    <input type="text" id="article-review" value="<?=$articleInfo['review']?>"></input>
		
	</div>
	
	<div>
		<div style="float:left;"> 
		<input id="editor-send-btn"  class="btn btn-success" type="button" value="Сохранить"/>
		</div>
		<div class="ajax-loading" id="page-editor-ajax"></div>
		<div class="clear"></div>
	</div>
</form>

<div id="dialog-modal-load-archive" style="display:none;" title="Загрузить файл">
<form id="archiveform">
	<input type="hidden" name="article_dir_name" value="<?=time();?>"/>
	<input name="archive" type="file"/><br/>
	<input type="submit" value="Загрузить">
</form>
</div>