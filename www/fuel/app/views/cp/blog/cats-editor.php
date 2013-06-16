<script>
function beforeStartAjax(){
    $("#cats-editor-ajax").addClass("ajax-loading-visible");
        CatAjax = false;
}
function afterAjax(){
    CatAjax = true;
        $("#cats-editor-ajax").removeClass("ajax-loading-visible");
}

$(document).ready(function(){
    CatAjax = true;
    //Удаление категорий
    $("#delete-select-cats-btn").click(function(){
        var section = $('#blog-section option:selected').val();
        var cat = $('#blog-category option:selected').val();
        if(section != 0 && cat > 0 && CatAjax && confirm("Удалить категорию?")){
          var url = "<?=Uri::base(false);?>"+"cp/blog/deletecats";
        	$.ajax({
    		    url: url,
    			type: "POST",
    		    dataType : "json",
    			data:{section:section, cat:cat},
    			beforeSend:beforeStartAjax,
                complete:afterAjax,
    		    success: function(data){
    		            if(data.answerCode == 0){
                          $("#blog-category option[value="+cat+"]").remove();
    		            }
    				    else if(data.answerCode == 1){
                            alert("Категория содержит записи ("+data.countArticles+" шт.)");
    				    }
    			},
    			error: function(data){
    				alert("Произошла ошибка во время ajax запроса "+url);
    			}
    		});
        }
    return false;
    });

    //Добавление категории
    $("#add-new-cats-btn").click(function(){
       var section = $('#blog-section option:selected').val();
      
	   if(section != 0){
	   	var newCatname = prompt("Название категории:");
		
	       if(newCatname != "" && newCatname != null && CatAjax){
	         var url = "<?=Uri::base(false);?>"+"cp/blog/addcat";
	        	$.ajax({
	    		    url: url,
	    			type: "POST",
	    		    dataType : "json",
	    			data:{section:section, newCatname:newCatname},
	    			beforeSend:beforeStartAjax,
	                complete:afterAjax,
	    		    success: function(data){
	    		            if(data.answerCode == 0){
	    		              $("#blog-category").append("<option value='"+data.insertedId+"'>"+newCatname+"</option>");
	    		            }
	    		            else
	                            alert(data.answerText);
	    			},
	    			error: function(data){
	    				alert("Произошла ошибка во время ajax запроса "+url);
	    			}
	    		});
	       }
	   }
     return false;
    });


});
</script>

<h4>Редактор категорий блога</h4>
<div class="ajax-loading" id="cats-editor-ajax"></div><br/>
<label>Раздел:</label>
	<select id="blog-section">
		<option value='0'></option>
        <? foreach($blogSections as $section)
            printf("<option value='%s'>%s</option>",$section['0'], $section['1']);
        ?>
	</select>
    <input id='ajaxCatLoadUrl' type='hidden' value='<?=Uri::base(false);?>cp/blog/ajaxGetCatList'/>
	<br/>
	<label>Категории:</label>
	<select id="blog-category" size='5'>
	</select><br/>
    <a href='#' id='add-new-cats-btn'>Добавить</a> | <a href='#' id='delete-select-cats-btn'>Удалить</a>