<script type="text/javascript">
$(document).ready(function(){
		tinymce.init({
	    selector: "textarea",
	    theme: "modern",
		language : 'ru',
	    plugins: [
	        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
	        "searchreplace visualblocks visualchars code fullscreen",
	        "insertdatetime media nonbreaking save table contextmenu directionality",
	        "emoticons textcolor paste"
	    ],
	    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | 						bullist numlist outdent indent | link image",
	    toolbar2: "preview media | forecolor backcolor emoticons",
	});
});
</script>

<h4>Добавление новой страницы</h4>
<form method="post" action="somepage">
	<input id="baseUrl" type="hidden" value="<?=Uri::base(false);?>"/>
	<label>Заголовок окна браузера:</label>
	<input style="width:645px;" type="text" >
	<br/>
	<label>Заголовок на странице:</label>
	<input style="width:645px;" type="text">
	<br/>
	<label>Адрес страницы (www.site.ru/page/<b>адрес</b>):</label>
	<input style="width:645px;" type="text">
	<br/>
	<label>Содержание:</label>
	
    <textarea name="content" style="height:300px; width:620px;"></textarea>
	<br/>
	<input  class="btn btn-success" type="button" value="Добавить"/>
</form>