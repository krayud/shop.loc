<script>

$(document).ready(function(){
var catsEditorAjaxEnable = true;

//добавление категории
$("#add_cat_btn").click(function(){
	var newCatName = prompt("Название новой категории:");
	if(newCatName != "" && newCatName != null && catsEditorAjaxEnable)
	{
		var parentId = $("#goods-cat option:selected").val(); 
		var url = "<?=Uri::base().'cp/boutique/addcat';?>";
		$.ajax({
			    url: url, 
				type: "POST",
			    dataType : "json",
				data:{parentId:parentId, newCatName:newCatName},
				beforeSend:beforeSendAjax,
				complete:afterSendAjax,
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
	return false;
});

//удаление категории
$("#del_cat_btn").click(function(){
	var catId = $("#goods-cat option:selected").val(); 
	if(catId != 0 && catsEditorAjaxEnable && confirm("Удалить категорию?"))
	{
		var url = "<?=Uri::base().'cp/boutique/delcat';?>";
		$.ajax({
			    url: url, 
				type: "POST",
			    dataType : "json",
				data:{catId:catId},
				beforeSend:beforeSendAjax,
				complete:afterSendAjax,
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
	return false;
});

function ShowAjaxLoading(display){
	if(display == true)
		$("#boutique-cats-ajax").addClass("ajax-loading-visible");
	else
		$("#boutique-cats-ajax").removeClass("ajax-loading-visible");
}

function beforeSendAjax(){
	catsEditorAjaxEnable = false;
	ShowAjaxLoading(true);
}
function afterSendAjax(){
	ShowAjaxLoading(false);
	catsEditorAjaxEnable = true;
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
?>
<h4>Редактор категорий бутика</h4>
<div class="ajax-loading" id="boutique-cats-ajax"></div>
<br/>
<label>Все категории:</label>
	<select size="20" id="goods-cat">
		<option selected value='0'>Родительская</option>
		<? PrintCatsByParentId($cats, 0);?>
	</select>
<br/>
<a href="#" id="add_cat_btn">Добавить</a> | <a id="del_cat_btn" href="#">Удалить</a>
	
	