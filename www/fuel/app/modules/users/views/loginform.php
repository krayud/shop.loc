<li class="first"><a id="open-loginDialog-btn" href="" title="Войти на сайт">Вход</a></li>
<li><a id="open-regDialog-btn" href="" title="Зарегистрироваться на сайте" >Регистрация</a></li>

<div id="dialog-modal-login" title="Вход на сайт">
	<form name="login-form" action="<?=Uri::base(false);?>users/ajax/auth">
	<label for="login-login">Логин (email адрес)</label><br/>
	  	<input id="login-login" type="text"/><br/>
	<label for="login-password">Пароль</label><br/>
	  	<input id="login-password" type="password"/><br/><br/>
	<center><button id="login-btn" type="submit" 
	  title="Отправить" class="button"><span><span>Войти</span></span></button></center>
	</form>
</div>

<div id="dialog-modal-reg" title="Регистрация пользователя">
	<form name="reg-form" action="<?=Uri::base(false);?>users/ajax/reg">
	  <label for="reg-login">Логин (email адрес)</label><br/>
	  	<input id="reg-login" type="text" value=""/><br/>
	  <label for="reg-password">Пароль (не менее 6 символов)</label><br/>
	  	<input id="reg-password" type="password" value=""/><br/>
	  <label for="reg-password-re">Повтор пароля</label><br/>
	  	<input id="reg-password-re" type="password" value=""/><br/><br/>
	  
	  <center><button id="reg-btn" type="submit" 
	  title="Отправить" class="button"><span><span>Отправить</span></span></button></center>
	</form>
</div>

<script>
jQuery(document).ready(function(){ 
		
		jQuery( "#dialog-modal-login, #dialog-modal-reg").dialog({
		  autoOpen: false,
		  width: 250,
	      modal: true
	    });

		jQuery("#open-regDialog-btn").click(function(){
			jQuery( "#dialog-modal-reg" ).dialog("open");
			return false;
		});
		jQuery("#open-loginDialog-btn").click(function(){
			jQuery( "#dialog-modal-login" ).dialog("open");
			return false;
		});
		
		jQuery("#reg-btn").click(Reg);
		jQuery("#login-btn").click(Auth);

//Процедура регистрации 
	function Reg(){
		var login = jQuery("#reg-login").val();
		var password = jQuery("#reg-password").val();
		var passwordRe = jQuery("#reg-password-re").val();
		var url = jQuery("form[name=reg-form]").attr("action");
		if(login != "" && password != "" && password.length >= 6 && password == passwordRe){
			jQuery.ajax({
			    url: url, 
				type: "POST",           
			    dataType : "json",    
				data: {login:login, password:password},
			    success: function (data){
			           if(data.answerCode == 0)
					   		Auth(login,password);
					   else 
					   		alert(data.answerText);
			    },
				error: function(data){
					alert("Произошла ошибка во время ajax запроса");
				}
			});
		}
		else
			alert("Неверно заполена форма регистрации.");
	return false;
	}
	
//Процедура авторизации
	function Auth(login, password){
		if(!login || !password)
		{
			login = jQuery("#login-login").val();
			password = jQuery("#login-password").val();
		}
		var url = jQuery("form[name=login-form]").attr("action");
		if(login != "" && password != "" && password.length >= 6){
			jQuery.ajax({
			    url: url, 
				type: "POST",           
			    dataType : "json",    
				data: {login:login, password:password},
			    success: function (data){
					if(data.answerCode == 0){
						set_cookie(data.cookieToken.name, data.cookieToken.value, data.cookieToken.time, "/","", "");
						location.reload(true);
					}
					else
						alert(data.answerText);
			           
			    },
				error: function(data){
					alert("Произошла ошибка во время ajax запроса");
				}
			});
		}
		else
			alert("Неверно заполена форма авторизации");
			
	return false;
	}		
		
});
</script>