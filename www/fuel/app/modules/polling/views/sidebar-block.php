<? if($poll != null){ ?>


<script type="text/javascript">
	
	jQuery(document).ready(function(){
	var PollingAjax = true;
	
	function beforeStartAjaxPolling(){
    	jQuery("#polling-send-ajax").addClass("ajax-loading-visible");
        PollingAjax = false;
	}
	function afterAjaxPolling(){
	    PollingAjax = true;
		jQuery("#polling-send-ajax").removeClass("ajax-loading-visible");
	}
		
		//Отправка формы голосования
		jQuery("#pollForm").submit(function(){
			
			var q_option = jQuery("input[name=vote]:checked").val();
			if(q_option == undefined)
				return false;
			var url = "<?=Uri::base(false);?>"+"polling/ajax/newvote";
			var q_id = "<?=$poll[0]['id'];?>";
			
			var user_ip = "<?=$_SERVER['REMOTE_ADDR'];?>";
			var user_email = "<?=$userInfo['email'];?>";
			jQuery.ajax({
		    url: url,
			type: "POST",
		    dataType : "text",
			data:{q_id:q_id, q_option:q_option, user_ip:user_ip, user_email:user_email},
			beforeSend:beforeStartAjaxPolling,
		   complete:afterAjaxPolling,
		    success: function(data){
				if(data != 0){
					jQuery('#polling-content').slideUp(300,function(){
						jQuery('#polling-content').html(data);
						jQuery('#polling-content').slideDown(300);
					});
					
				}
				else
					alert("Ошибка в процессе обработки данных");		  
			},
			error: function(data){
				alert("Произошла ошибка во время ajax запроса "+url);
			}
		});
			
			return false;
		});
	});
</script>
<form id="pollForm" action="" method="post">
        <p class="block-subtitle"><?=$poll[0]["q_title"];?></p>
                    <ul id="poll-answers">
	<? 
	foreach($poll as $q)
		printf("<li>
                <input type='radio' name='vote' class='radio poll_vote' id='%s' value='%s' />
                <span class='label'><label for='%s'>%s</label></span>
            	</li>",$q["option_id"],$q["option_id"],$q["option_id"],$q["option_title"]);
		
	?>

         			</ul>
<div class="actions">
<div style="float: left;">
	<button type="submit" title="Отправить" class="button"><span><span>Отправить</span></span></button>
</div>
<div class="ajax-loading" style="float: left; margin: 7px 0px 0px 10px" id="polling-send-ajax"></div><br/>
</div>
<div class="clear"></div>
</form>
<? }?>