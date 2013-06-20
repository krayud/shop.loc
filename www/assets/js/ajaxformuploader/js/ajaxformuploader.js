var ajaxFormUploader = function(){
	this.init = function(data){
		this.vaName = data.vaName; // Имя переменной, у которой необходимо будет вызвать callback
		this.formId = data.formId; // id формы (без #!)
		this.action = data.action; // Куда отправлять форму
		this.before = data.before; // Функция перед отправкой формы
		this.callback = data.callback; // callback функция

		this.frameName = "ajaxFormUploader"+this.formId; //Имя и id для iframe (уникален для каждой формы за счет this.formId)
		//Добавляет iframe, в который придет ответ
		$("body").append("<iframe style='display:none;' id='"+this.frameName+"' name='"+this.frameName+"'></iframe>");
		
		//Настройка самой формы
		$("#"+this.formId).attr({
            method : "post",
            enctype: "multipart/form-data",
            action : this.action,
            target : this.frameName,
        });

		//Дополнительный настройки 
        var settings = {
          "varName" : this.vaName, 
        };
		//Добавление служебной информации к форме
		$("#"+this.formId).append("<input type='hidden' name='ajaxFormUploaderSettings' value='"+JSON.stringify(settings)+"'>");

		/*Функция перед отправкой формы
		*/
		$("#"+this.formId).submit(function(){
			return data.before();
		});
	}
}

