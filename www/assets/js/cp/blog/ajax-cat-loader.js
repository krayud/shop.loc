$(document).ready(function(){
var blog_section = "#blog-section";
var blog_category = "#blog-category";

//Взять значение при каждом новом выборе
$(blog_section).change(function(){
	var value = $(blog_section=" option:selected").val();
	loadCatList(value);
});

function loadCatList(value){
	var url = $("#ajaxCatLoadUrl").val();
	if(value != 0)
	{
		$.ajax({
		    url: url, 
			type: "POST",           
		    dataType : "json",
			data:{section:value},
			beforeSend:beforeAddPage,
		    success: function(data){
					if(data.code == 0){
						ShowAjaxLoading(false);
						for(i = 0; i < data.catList.length;i++)
							appendCat(data.catList[i]);

					}
			},
			error: function(data){
				alert("Произошла ошибка во время ajax запроса "+url);
			}
		});
	}
	else
		$(blog_category).html("<option value='0'></>");
}

function appendCat(cat){
	$(blog_category).append("<option value='"+cat.cats_id+"'>"+cat.cats_title+"</>");
}		
	
function ShowAjaxLoading(display){
	if(display == true)
		$(blog_category).html("<option value='-1'>Загрузка...</>");
	else
		$(blog_category).html("");
}
function beforeAddPage(){
	ShowAjaxLoading(true);
}

});