<li class="first"><a href="#">Сообщения</a></li>
<li><a href="#">Личный кабинет</a></li>
	<? if($userInfo["level"] >= 2) {?>	
		<li><a id="switcher-fast-edit" href="#">Включить редактор</a></li>
		<li><a href="<?=Uri::base(false);?>cp">Панель управления</a></li>
	<?}?>		




<li>
	<form name="logout-form" action="<?=Uri::base(false);?>users/ajax/logout">
		<a id="logoutBtn" href="#">Выход</a>
	</form>
</li>

<script>

jQuery(document).ready(function(){
	//Переключатель быстрого редактора 
	jQuery("#switcher-fast-edit").click(function(){
		FASTEDITMODE = !FASTEDITMODE;
		if(FASTEDITMODE)
			jQuery(this).text("Выключить редактор");
		else
			jQuery(this).text("Включить редактор");
		return false;
	});
	
	
	//Выход 
	jQuery("#logoutBtn").click(function(){
		var url = jQuery("form[name=logout-form]").attr("action");
		jQuery.ajax({
		    url: url, 
			type: "POST",           
		    dataType : "json",
		    success: function (data){
					if(data.answerCode == 0){
						delete_cookie(data.cookieName);
						delete_cookie("filebrowserAccess");// Закрыть доступ к файловому менеджеру tinymce
						location.reload(true);
					}
		    },
			error: function(data){
				alert("Произошла ошибка во время ajax запроса");
			}
		});
	return false;
	});
	
});

</script>
