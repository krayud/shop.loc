<script>
	
$(document).ready(function(){
	
	function beforeStartAjax(){
    $("#polling-editor-ajax").addClass("ajax-loading-visible");
        GroupAjax = false;
	}
	function afterAjax(){
	    GroupAjax = true;
	        $("#polling-editor-ajax").removeClass("ajax-loading-visible");
	}
	
	var q_id = 3;
	
	$("#0").val("Еще вариант");
	//Добавление нового варианта ответа
	$('.q_options').on('focus', ".q_option", function(e){
		attr_id = $(this).attr("id");
		if(attr_id == 0){
		       $(this).attr("id", q_id);
					$(this).val("");
					q_id++;
					$(".q_options").append("<input class='q_option' id='0' type='text' value='Еще вариант'></input><br/>");
			}
			
    });
	
	//Отправка формы
	$("form[name=polling-editor]").submit(function(){
		var url = "<?=Uri::base(false);?>"+"cp/polling/addnewpoll";
		var q_title = $(".q_title").val(); 
		var q_type = $("#q_type :selected").val();
		var options = [];
		var counter = 0;
		$(".q_option").each(function(){
			op_id = $(this).attr("id");
			op_text = $(this).val();
			if(op_id != 0 && op_text != ""){
				options[counter] = op_text; 
				counter++;
			}
		});
		$.ajax({
		    url: url,
			type: "POST",
		    dataType : "json",
			data:{q_title:q_title, q_type:q_type, options:JSON.stringify(options)},
			beforeSend:beforeStartAjax,
		    complete:afterAjax,
		    success: function(data){
		            if(data.answerCode == 0){
		                  alert(data.answerText);
		            }
				    else
							alert(data.answerText);
			},
			error: function(data){
				alert("Произошла ошибка во время ajax запроса "+url);
			}
		});
		
		return false;
	});
	
});
	
</script>

<h4>Новое голосование</h4>
<div class="ajax-loading" id="polling-editor-ajax"></div><br/>
<form name="polling-editor" >
Кто может учавствовать в опросе:<br/>
	<select id="q_type">
		<option value="1">Все посетители</option>
		<option value="2">Только зарегистрированные</option>
	</select><br/>
	Вопрос<br/>
	<input class="q_title" type="text"></input><br/>
	Варианты ответа:<br/>
	<div class="q_options">
		<input class="q_option" id="1" type="text"></input><br/>
		<input class="q_option" id="2" type="text"></input><br/>
		<input class="q_option" id="0" type="text" value="Еще вариант"></input><br/>
	</div>
	
	<input type="submit" value="Сохранить"></input>
	
</form>