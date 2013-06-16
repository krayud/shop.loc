<button id="open-question-btn" type="button" title="Задать вопрос" class="button">
 <span><span>Задавайте вопросы!</span></span>
</button>

<div id="dialog-modal-question" title="Задать вопрос">
	<div class="contacts-footer-content">
        <form action="<?=Uri::base(false);?>questions/ajax/addquestion" id="questionForm">

			<label for="question-name">Ваше имя</label><br/>
	  		<input id="question-name" type="text"/><br/>
		
			<label for="question-email">Email</label><br/>
	  		<input id="question-email" type="text" value="<?=$userInfo["email"];?>"/><br/>
			
			<label for="question-phone">Телефон (не обязательно)</label><br/>
	  		<input id="question-phone" type="text"/><br/>
			
			<label for="question-text">Вопрос</label><br/>
			<textarea id="question-text" cols="40" rows="7"></textarea><br/>
			<p style='font-size: 8pt; text-align: justify;'>Замечание! Если Вы долго не получаете ответногописьма - проверьте раздел "спам", возможно оно там.</p>
			<br/>
           <center>
<div>
	<div style="float: left;">
	<button type="submit" title="Задать вопрос" class="button"><span><span>Отправить</span></span></button>
	</div>
	<div class="ajax-loading" style="float: left; margin: 7px 0px 0px 10px" id="question-send-ajax"></div><br/>
<div class="clear"></div>
</div>
		   </center> 
        </form>
    </div>
</div>

<script>
jQuery(document).ready(function(){ 
		
	var QuestionsAjax = true;
	
	function beforeStartAjaxQuestions(){
    	jQuery("#question-send-ajax").addClass("ajax-loading-visible");
        QuestionsAjax = false;
	}
	function afterAjaxQuestions(){
	    QuestionsAjax = true;
		jQuery("#question-send-ajax").removeClass("ajax-loading-visible");
	}
		
		
		jQuery("#dialog-modal-question").dialog({
		  autoOpen: false,
		  width: 310,
	      modal: true
	    });

		jQuery("#open-question-btn").click(function(){
			jQuery( "#dialog-modal-question" ).dialog("open");
			return false;
		});
		
		
		jQuery("#questionForm").submit(function(){
			
			var url = "<?=Uri::base(false);?>"+"questions/ajax/addnewquestion";
			var name = jQuery("#question-name").val();
			var phone = jQuery("#question-phone").val();
			var email = jQuery("#question-email").val();
			var q_text = jQuery("#question-text").val();
			
			if(name != "" && email != "" && q_text != ""){
			if(QuestionsAjax)
				jQuery.ajax({
				    url: url,
					type: "POST",
				    dataType : "json",
					data:{name:name, phone:phone, email:email, text:q_text},
					beforeSend:beforeStartAjaxQuestions,
				   	complete:afterAjaxQuestions,
				    success: function(data){
						if(data.answerCode == 0){
							jQuery("#question-text").val("");
							alert(data.answerText);
							jQuery( "#dialog-modal-question" ).dialog("close");
						}
						else
							alert("Ошибка в процессе обработки данных");		  
					},
					error: function(data){
						alert("Произошла ошибка во время ajax запроса "+url);
					}
				});
			}
			else
				alert("Заполните все обязательные поля");
			return false;
		});
});
</script>