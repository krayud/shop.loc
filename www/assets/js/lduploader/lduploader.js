//Подключение скриптов и стилей, если нужно отобразить fule input не по дефолту 
function AppendInputStyleJSCSS(basePath){

  var styleModPath = 'input_style/';

  var css = basePath+styleModPath+'file-input.css';
  var js = basePath+styleModPath+'file-input.js';
 
  var tag_css = document.createElement('link');
  tag_css.rel = 'stylesheet';
  tag_css.href = css; // здесь указывается URL стилевого файла
  tag_css.type = 'text/css';
  var tag_head = document.getElementsByTagName('head');
  tag_head[0].appendChild(tag_css);

   var tag_js = document.createElement('script');
  tag_js.type = 'text/javascript';
  tag_js.src = js; // здесь указывается URL стилевого файла
  var tag_head = document.getElementsByTagName('head');
  tag_head[0].appendChild(tag_js);
}

LDUploader = {
    init: function(data){
      this.form = data.form;
      this.inputName = data.inputName;
      this.realName = data.realName;
      this.resize = data.resize;
      this.charsetToSave = data.charsetToSave;
	    this.defaultName = data.defaultName;
      this.extensions = data.extensions;
      this.normalInputStyle = data.normalInputStyle;
      this.uploaderPath = location.protocol+"//"+location.hostname+data.uploaderPath;
      this.action = this.uploaderPath+"upload.php";
      this.uploadPath = data.uploadPath;
      this.before = data.before;
      this.callback = data.callback;
      
      if(this.normalInputStyle == "true")
        AppendInputStyleJSCSS(this.uploaderPath);

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
          "resize" : LDUploader.resize,
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