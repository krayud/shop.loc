<script>
function beforeStartAjax(){
    $("#groups-editor-ajax").addClass("ajax-loading-visible");
        GroupAjax = false;
}
function afterAjax(){
    GroupAjax = true;
        $("#groups-editor-ajax").removeClass("ajax-loading-visible");
}

$(document).ready(function(){
    GroupAjax = true;
    //Удаление группы
    $("#delete-select-groups-btn").click(function(){
     
        var group = $('#page-groups option:selected').val();
        if(group > 0 && GroupAjax && confirm("Удалить группу?")){
          var url = "<?=Uri::base(false);?>"+"cp/page/deletegroup";
        	$.ajax({
    		    url: url,
    			type: "POST",
    		    dataType : "json",
    			data:{group:group},
    			beforeSend:beforeStartAjax,
                complete:afterAjax,
    		    success: function(data){
    		            if(data.answerCode == 0){
                          $("#page-groups option[value="+group+"]").remove();
    		            }
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

    //Добавление группы
    $("#add-new-groups-btn").click(function(){

	   	var newGroupName = prompt("Название группы:");
		
	       if(newGroupName != "" && newGroupName != null && GroupAjax){
	         var url = "<?=Uri::base(false);?>"+"cp/page/addgroup";
	        	$.ajax({
	    		    url: url,
	    			type: "POST",
	    		    dataType : "json",
	    			data:{newGroupName:newGroupName},
	    			beforeSend:beforeStartAjax,
	                complete:afterAjax,
	    		    success: function(data){
	    		            if(data.answerCode == 0){
	    		              $("#page-groups").append("<option value='"+data.insertedId+"'>"+newGroupName+"</option>");
	    		            }
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


});
</script>

<h4>Редактор групп статических страниц</h4>
<div class="ajax-loading" id="groups-editor-ajax"></div><br/>
<p>При удалении группы, в которой содержаться страницы, <br/>связь между этими страницами будет автоматически разорвана.</p>
	<select id="page-groups" size='5'>
		<? foreach($groups as $group)
            printf("<option value='%s'>%s</option>",$group['id'], $group['title']);
        ?>
	</select><br/>
    <a href='#' id='add-new-groups-btn'>Добавить</a> | <a href='#' id='delete-select-groups-btn'>Удалить</a>