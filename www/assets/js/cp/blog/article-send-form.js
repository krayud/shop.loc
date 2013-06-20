$(document).ready(function(){
var articleEditorAjaxEnable = true;


	$("#editor-send-btn").click(function(){
		tinyMCE.triggerSave(); // Сохранение исходного кода в textarea

		var url = $("form[name=article-editor]").attr("action");
		var editId = $("#editArticleId").val();
		var section = $("#blog-section option:selected").val();
		var cat = $("#blog-category option:selected").val();

		var display_in_mini_block = 0;
			if($("#display-in-mini-block").prop("checked"))
					display_in_mini_block = 1;

		var title = $("#article-title").val();
		var img = $("#big-img-src").val();
		var description = $("#article-description").val();
		var text = $("#article-text").val();
		if(url!= "" && section != 0  && cat != 0 && cat != undefined  && title != "" && description != "" && text != ""){
				if(articleEditorAjaxEnable){
					$.ajax({
					    url: url, 
						type: "POST",
					    dataType : "json",
						data:{editId:editId, section:section, cat:cat, display_in_mini_block:display_in_mini_block, 
							title:title, description:description, text:text, img:img},
						beforeSend:beforeAddPage,
						complete:afterAddPage,
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
		}
		else
			alert("Заполните необходимые поля");

	});
	function ShowAjaxLoading(display){
		if(display == true)
			$("#page-editor-ajax").addClass("ajax-loading-visible");
		else
			$("#page-editor-ajax").removeClass("ajax-loading-visible");
	}
	function beforeAddPage(){
		articleEditorAjaxEnable = false;
		ShowAjaxLoading(true);
	}
	function afterAddPage(){
		ShowAjaxLoading(false);
		articleEditorAjaxEnable = true;
	}
});