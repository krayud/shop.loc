<script>

$(document).ready(function(){
	
//Модальное окно
$("#dialog-modal-load-photo").dialog({
  autoOpen: false,
  width: 450,
  modal: true
});
$("#editor-append-photo-btn").click(function(){
	$("#dialog-modal-load-photo").dialog("open");
});
	
//Загрузчик  изображений
	a = new ajaxFormUploader();
	a.init({
		vaName:"a",
		formId:"photoForm",
		action: "<?=Uri::base(false)?>"+"assets/js/ajaxformuploader/php/goods_photo_upload/uploader.php",
		before: function(){
			//return false; // Отменяет отправку формы
		},
		callback: function(result){
			if(result.code == 0){
				$("#dialog-modal-load-photo").dialog("close");
				alert("Загружено файлов: "+result.downloadedPhoto+" из "+result.totalPhoto);
				$("#goods-photo").val(result.photoNames);
			}
			else
				alert(result.text);
		}
	});
	
//Отправка формы
var goodsEditorAjaxEnable = true;
$("#editor-send-btn").click(function(){
	var url = $("#goods-editor").attr("action"); 
	var edited_id = $("#edited_id").val();
	var title = $("#goods-title").val();
	var cat = $("#goods-cat option:selected").val();
	var photo = $("#goods-photo").val();
	var description = $("#goods-description").val();
	var goods_price = $("#goods-price").val();
	var goods_price_discount = $("#goods-price-discount").val();
	var dir_name = $("#goods_dir_name").val();

	if(url!= "" && title != "" && cat >=1 && description != "" && goods_price != "")
	{
			if(goodsEditorAjaxEnable)
			{
				$.ajax({
				    url: url, 
					type: "POST",
				    dataType : "json",
					data:{edited_id:edited_id,title:title, cat:cat, photo:photo, 
					description:description, goods_price:goods_price, 
					goods_price_discount:goods_price_discount, dir_name:dir_name},
					beforeSend:beforeSendGoods,
					complete:afterSendGoods,
				    success: function(data){
							if(data.answerCode == 0)
								location.reload();
							else
								alert(data.answerText);
					},
					error: function(data){
						alert("Произошла ошибка во время ajax запроса "+url);
					}
				});
			}
	}
	else
		alert("Заголовок, описание и цена обязательные поля");
});

function ShowAjaxLoading(display){
	if(display == true)
		$("#goods-editor-ajax").addClass("ajax-loading-visible");
	else
		$("#goods-editor-ajax").removeClass("ajax-loading-visible");
}

function beforeSendGoods(){
	goodsEditorAjaxEnable = false;
	ShowAjaxLoading(true);
}
function afterSendGoods(){
	ShowAjaxLoading(false);
	goodsEditorAjaxEnable = true;
}
	
});

</script>

<?

function PrintCatsByParentId($cats, $editedId, $parent_id = 0){
static $level = -1;

	if(empty($cats[$parent_id]))
		return;
		
	$level++;
	foreach($cats[$parent_id] as $cat)
	{
		if($editedId == $cat['cat_id'])
			$selected = "selected";
		else
			$selected = "";
		printf("<option %s value='%s'>%s %s</option>",
							$selected,
							$cat['cat_id'],
							 str_repeat("--",$level),
							$cat['cat_title']);
							
		PrintCatsByParentId($cats,$editedId, $cat['cat_id']);
	}	
	$level--;
}



$url = Uri::base(false)."cp/boutique/add_update/";

if(isset($goodsInfo)){// если запись редактируется
    $goodsInfo = $goodsInfo[0];
	echo "<h4>Редактирование товара</h4>";
}
else{// если добавляется новая запись
    $goodsInfo = null;
	$goodsInfo['dir_name'] = time();
	$goodsInfo['id'] = 0;
	echo "<h4>Добавление нового товара</h4>";
}
?>
 <form id="goods-editor" name="goods-editor"  action="<?=$url;?>">
<div>
	<input type="hidden" id="edited_id" value="<?=$goodsInfo['id'];?>"/>

	<label>Заголовок:</label>
	<input id="goods-title" type="text" value="<?=$goodsInfo['title'];?>">
	<br/>

	<label>Категория:</label>
	<select id="goods-cat">
		<? PrintCatsByParentId($cats, $goodsInfo['cat_id']);?>
	</select>
	<br/>

	<br/>
	<input id="editor-append-photo-btn"  class="btn btn-info" type="button" 
	value="Загрузить фотографии"/><br/>
	<br/>

	<textarea id="goods-photo"><?=$goodsInfo['photo'];?></textarea><br/>
	
	<label>Описание товара:</label>
	<textarea id="goods-description"><?=$goodsInfo['description'];?></textarea><br/>
	
	<label>Цена:</label>
	<input id="goods-price" type="text" value="<?=$goodsInfo['price'];?>">
	<br/>
	
	<label>Цена со скидкой:</label>
	<input id="goods-price-discount" type="text" value="<?=$goodsInfo['price_discount'];?>">
	<br/>
</div>	
	<div>
		<div style="float:left;"> 
			<input id="editor-send-btn"  class="btn btn-success" type="button" value="Сохранить"/>
		</div>
		<div class="ajax-loading" id="goods-editor-ajax"></div>
		<div class="clear"></div>
	</div>
</form>


<div id="dialog-modal-load-photo" style="display:none;" title="Загрузить файл">
	<form id="photoForm" enctype="multipart/form-data">
		<input id="goods_dir_name" name="goods_dir_name" type="hidden" value="<?=$goodsInfo['dir_name'];?>"/>
		<input name="goods_photo[]" type="file" multiple /><br/>
		<input type="submit" value="Загрузить">
	</form>
</div>
