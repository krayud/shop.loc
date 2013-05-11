var LDUploader = {
    init: function(data){
      this.form = data.form;
      this.inputName = data.inputName;
      this.realName = data.realName;
      this.charsetToSave = data.charsetToSave;
	  this.defaultName = data.defaultName;
	  this.extensions = data.extensions;
      this.action = location.protocol+"//"+location.hostname+data.action;
      this.uploadPath = data.uploadPath;
      this.before = data.before;
      this.callback = data.callback;
      this.enable();
    },
    enable : function(){
        $(this.form).attr({
            method : "post",
            enctype: "multipart/form-data",
            action : LDUploader.action,
            target : "superframe",
          });

        //Опции загрузки файла
        var settings = {
          "inputName" : LDUploader.inputName,
          "realName"  : LDUploader.realName,
          "charsetToSave" : LDUploader.charsetToSave,
          "uploadPath"  : LDUploader.uploadPath,
		  "defaultName" : LDUploader.defaultName,
		  "extensions" : LDUploader.extensions,
          };
        //Поле с опциями, передается обработчику
        $(this.form).append("<input name='settings' value='"+JSON.stringify(settings)+"' style='display:none'>");

        //Фрейм
        $(this.form).append("<iframe style='display:none;' id='superframe' name='superframe'></iframe>");
        
        $(this.form).submit(function(){
			if($("input[name="+LDUploader.inputName+"]").val() == ""){
				alert("Выберите файл");
				return false;
			}
				
          	LDUploader.before();
        });
    },
}