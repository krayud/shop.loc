<li class="first"><a href="#"><?=$userInfo["email"];?></a></li>
<li><? if($userInfo["level"] >= 2) {?>
		<a href="#">Панель управления</a>
	<?}?>		
</li>
<li>
	<form name="logout-form" action="<?=Uri::base(false);?>users/ajax/logout">
		<a id="logoutBtn" href="">Выход</a>
	</form>
</li>


<script>

jQuery(document).ready(function(){
	
	jQuery("#logoutBtn").click(function(){
		var url = jQuery("form[name=logout-form]").attr("action");
		jQuery.ajax({
		    url: url, 
			type: "POST",           
		    dataType : "json",
		    success: function (data){
					if(data.answerCode == 0){
						delete_cookie(data.cookieName);
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
