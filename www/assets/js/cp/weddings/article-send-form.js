$(document).ready(function(){
	
articleEditorAjaxEnable = true;

	$("#editor-send-btn").click(function(){
	
	var url = $("form[name=article-editor]").attr("action");
	var title = $("#article-title").val();
	var img = $("#big-img-src").val();
	var editId = $("#editArticleId").val();
	var article_photos = $("#article-photos").val();
	var article_video = $("#article-video").val();
	var article_review = $("#article-review").val();
	
	
	if(title != "" && article_photos != "")
	{
		if(articleEditorAjaxEnable)
		$.ajax({
			    url: url, 
				type: "POST",
			    dataType : "json",
				data:{editId:editId, title:title, review:article_review, photo:article_photos, video:article_video, img:img},
				beforeSend:beforeAddPage,
				complete:afterAddPage,
			    success: function(data){
						alert(data.answerText);
						if(data.answerCode == 0)
							location.reload();
				},
				error: function(data){
					alert("Произошла ошибка во время ajax запроса "+url);
				}
		});
		
	}
	else
		alert("Заголовок и фотографии - обязательные поля");
	});


	
	
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