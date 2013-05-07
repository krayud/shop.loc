jQuery(document).ready(function(){
	
	var cms_content_div = "#cms-content-div";
	var cms_content_editor = "#cms-content-editor";
	var timeShow = 0;
	var fastEditPage = false;
	
	jQuery("#fast-edit-btn").click(function(){
		fastEditPage = !fastEditPage;
		if(fastEditPage){
			HidePageContentAndShowEditor();
			jQuery(this).text("Назад");
		}
		else{
			HideEditorAndShowPageContent();
			jQuery(this).text("Быстрое редактирование");
		}
			
		return false;
	});

	jQuery("#fast-edit-btn-cancel").click(function(){
		HideEditorAndShowPageContent();
		return false;
	});
	
	function HidePageContentAndShowEditor(){
		jQuery(cms_content_div).slideUp(timeShow,function(){
			jQuery(cms_content_editor).slideDown(timeShow);
		});
	}
	
	function HideEditorAndShowPageContent(){
		jQuery(cms_content_editor).slideUp(timeShow,function(){
			jQuery(cms_content_div).slideDown(timeShow);
		});
	}

//Сохранение изменений в контенте
	jQuery("#fastSaveBtn").click(function(){
		tinyMCE.triggerSave(); // Сохранение исходного кода в textarea
		var fastEditUrl = jQuery("#fastEditForm").attr("action");
		var fastEditId = jQuery("#fastEditPageId").val();
		var fastEditContent = jQuery("#fastEditContent").val();
		var fastEditAjaxEnable = true;
		
		if(fastEditAjaxEnable){
			jQuery.ajax({
			    url: fastEditUrl, 
				type: "POST",           
			    dataType : "json",
				data:{pageId:fastEditId, content:fastEditContent},
				beforeSend:beforeAddPage,
				complete:afterAddPage,
			    success: function(data){
						alert(data.answerText);
						if(data.answerCode == 0)
							jQuery(cms_content_div).html(fastEditContent);
				},
				error: function(data){
					alert("Произошла ошибка во время ajax запроса "+url);
				}
			});
		}
		return false;
	});
	
	function ShowAjaxLoading(display){
		if(display == true)
			jQuery("#fast-editor-ajax").css("display", "inline");
		else
			jQuery("#fast-editor-ajax").css("display","none");
	}
	function beforeAddPage(){
		fastEditAjaxEnable = false;
		ShowAjaxLoading(true);
	}
	function afterAddPage(){
		ShowAjaxLoading(false);
		fastEditAjaxEnable = true;
	}

});