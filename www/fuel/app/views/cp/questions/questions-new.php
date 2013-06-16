<h4>Новые вопросы</h4>

<?
if($questions != null){
?>

<script>

$(document).ready(function(){
	jQuery("#dialog-modal-answer").dialog({
		  autoOpen: false,
		  width: 450,
	      modal: true
	    });

		jQuery(".q_row").click(function(e){
			var id = jQuery(this).attr("id");
			$("#q_id").val(id);
			var text = $(".q_text[id="+id+"]").text();
			$("#question-text").text(text);
			
			jQuery( "#dialog-modal-answer" ).dialog("open");
			
			return false;
		});
		
		
	var AnswerAjax = true;
	
	function beforeStartAjaxAnswer(){
    	jQuery("#answer-send-ajax").addClass("ajax-loading-visible");
        AnswerAjax = false;
	}
	function afterAjaxAnswer(){
	    AnswerAjax = true;
		jQuery("#answer-send-ajax").removeClass("ajax-loading-visible");
	}
		

		
		
		jQuery("#answer-form").submit(function(){
			
			var url = "<?=Uri::base(false);?>"+"questions/ajax/addanswer";
			var q_id = $("#q_id").val();
			var answer = $("#question-answer").val();
			
			if(answer != ""){
			if(AnswerAjax)
				jQuery.ajax({
				    url: url,
					type: "POST",
				    dataType : "json",
					data:{q_id:q_id, answer:answer},
					beforeSend:beforeStartAjaxAnswer,
				   	complete:afterAjaxAnswer,
				    success: function(data){
						if(data.answerCode == 0){
							$("#question-answer").val("");
							jQuery( "#dialog-modal-answer" ).dialog("close");
							$(".q_row[id="+q_id+"]").fadeOut(300);
							alert(data.answerText);
						}
						else
							alert(data.answerText);		  
					},
					error: function(data){
						alert("Произошла ошибка во время ajax запроса "+url);
					}
				});
			}
			else
				alert("Ответ не может быть пустым");
			return false;
		});
		
});
</script>

<div id="dialog-modal-answer" style="display:none;" title="Ответить на вопрос">

<form id="answer-form">
<input type="hidden" id="q_id"/>

<label for="question-text">Вопрос</label>
<textarea disabled="true" id="question-text" rows="10" style="width:400px"></textarea><br/>

<label for="question-answer">Ответ</label>
<textarea id="question-answer" rows="10" style="width:400px"></textarea><br/>

<div>
	<div style="float: left;">
	<input id="answer-send-btn"  class="btn btn-success" type="submit" value="Ответить"/>
	</div>
	<div class="ajax-loading" style="float: left; margin: 5px 0px 0px 10px;" id="answer-send-ajax"></div>
	<div class="clear"></div>
</div>
</form>

</div>


<table class="table table-bordered table-hover">
	<thead>
    <tr>
      <th>Дата</th>
      <th>Имя</th>
      <th>Email</th>
      <th>Телефон</th>
      <th>Вопрос</th>
    </tr>
  </thead>
  <tbody>
  <?
    foreach($questions as $question)
    {
    	echo "<tr class='q_row' id='".$question['id']."'>";
          echo "<td>".date("d.m.Y",$question["date"])."</td>";
          echo "<td>".$question["name"]."</td>";
          echo "<td>".$question["email"]."</td>";
    	  echo "<td>".$question["phone"]."</td>";
          echo "<td class='q_text' id='".$question['id']."'>".$question["text"]."</td>";
        echo "</tr>";
    }
?>
  </tbody>
</table>

<?
}
else
	echo "<p>Новых вопросов не найдено</p>";
?>