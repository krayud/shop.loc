jQuery(document).ready(function(){
	
	var cms_content_div = "#cms-content-div";
	var cms_content_editor = "#cms-content-editor";
	var timeShow = 200;
	
	//Показывать облать редактирования при наведении
	jQuery("#cms-content-div").mouseenter(function(){
		if(FASTEDITMODE)
			jQuery(this).addClass("fast-edit-area");
	});
	jQuery("#cms-content-div").mouseleave(function(){
		jQuery(this).removeClass("fast-edit-area");
	});
	jQuery("#cms-content-div").mouseup(function(){
		if(FASTEDITMODE)
		HidePageContentAndShowEditor();
	});

	
	function HidePageContentAndShowEditor(){
		var ContentText = jQuery(cms_content_div).html();
		tinyMCE.execCommand('mceRemoveControl', false, 'fastEditContent');
		jQuery("#fastEditContent").val(ContentText);
		tinyMCE.execCommand('mceAddControl', false, 'fastEditContent');
			
		jQuery(cms_content_div).fadeOut(timeShow,function(){
			jQuery(cms_content_editor).fadeIn(timeShow);
		});
	}
	
	function HideEditorAndShowPageContent(){
		
		jQuery(cms_content_editor).fadeOut(timeShow,function(){
			jQuery(cms_content_div).fadeIn(timeShow);
		});
	}

//Кнопка отмены (назад)
jQuery("#fast-edit-btn-cancel").click(function(){
		HideEditorAndShowPageContent();
		return false;
	});

//Сохранение изменений в контенте
	jQuery("#fast-edit-save-btn").click(function(){
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