$(document).ready(function(){
var pageNewAjaxEnable = true;

//Замена пробелов в поле для URI страницы
	$("#editor-uri").change(function(){
		var original = $("#editor-uri").val();
		var newStr = original.replace(/\s/g, '_');
		newStr = newStr.replace(/^_/, '');
		newStr = newStr.replace(/_$/, '');
		$("#editor-uri").val(newStr);
	});
	
//Копирование текста из "Текст ссылки" в "Заголовок в браузере" 
	$("#editor-link-text").keyup(function(){
		$("#editor-title").val($("#editor-link-text").val());
	});

$("#display-page-in-menu").change(function(){
	var status = $("#display-page-in-menu").prop("checked");
	if(status == false){
		$("#editor-link-text").attr("disabled","disabled");
	}
	else
		$("#editor-link-text").removeAttr("disabled");
});
	
	$("#editor-send-btn").click(function(){
		tinyMCE.triggerSave(); // Сохранение исходного кода в textarea
		var url = $("form[name=page-editor]").attr("action");
		var editId = $("#editPageId").val();
		var title = $("#editor-title").val();
		var contentTitle = $("#editor-content-title").val();
		var pageUri = $("#editor-uri").val();
		var linkText = $("#editor-link-text").val();
		var content = $("textarea").val();
		var display = 0;
			if($("#display-page-in-menu").prop("checked"))
				display = 1;
		if(linkText == "" && display == 0)
			linkText = pageUri;
		if(url!= "" && title != "" && pageUri != "" && linkText != "" && content != ""){
			var reg = /^([A-Za-z0-9-_]+)$/;
			if(reg.test(pageUri)){
				if(pageNewAjaxEnable){
					$.ajax({
					    url: url, 
						type: "POST",           
					    dataType : "json",
						data:{pageUri:pageUri,editId:editId, display:display, linkText:linkText, 
							title:title, contentTitle:contentTitle, content:content},
						beforeSend:beforeAddPage,
						complete:afterAddPage,
					    success: function(data){
								alert(data.answerText);
								if(editId == ''){
									$("#editor-title").val("");
									$("#editor-content-title").val("");
									$("#editor-uri").val("");
									$("#editor-link-text").val("");
									tinyMCE.activeEditor.setContent('');
								}
						},
						error: function(data){
							alert("Произошла ошибка во время ajax запроса "+url);
						}
					});
				}
			}
			else
				alert("Некорректный адрес страницы");
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
		pageNewAjaxEnable = false;
		ShowAjaxLoading(true);
	}
	function afterAddPage(){
		ShowAjaxLoading(false);
		pageNewAjaxEnable = true;
	}
});