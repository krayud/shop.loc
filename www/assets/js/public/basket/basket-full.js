 jQuery(document).ready(function(){

   //При изменении кол-ва товара
   jQuery(".good_count_input").change(function(){
     var newCount = jQuery(this).val();
     if(newCount <= 0 || !parseInt(newCount) || Math.ceil(newCount) != newCount)
     {
        alert("Неверное кол-во товара");
        jQuery(this).val(1);
     }
        RefreshBasket();
   });

 //Обновление корзины (количества товаров, общей стоимости, запись данных в куки)
 function RefreshBasket()
 {
    var newTotalPrice = CalcTotalSum();
    var newGoodsCount = CountGoodsInPage();
    jQuery(".total_sum_basket").text(newTotalPrice);


        var newGoodsListJSON = CreateNewGoodsArray();
        jQuery.cookie("basket",newGoodsListJSON, {
                                                 expires: 60,
                                                 path: "/",
                                                 secure: false
        });

   RefreshMiniBasket();
 }

//Пересчет и возврат итоговой суммы
function CalcTotalSum(){
  var result = 0;
    jQuery(".good_row").each(function(){
           var ths = jQuery(this).children(".good_content_right"); //Все поля товара
           var count = jQuery(ths).children(".good_count").children(".good_count_input").val();
           var priceForOne = jQuery(ths).children(".good_price").children(".good_price_span").text();
           result += priceForOne * count;
       });
    return result;
}
 //Создание нового списка товаров в корзине и возврат
 function CreateNewGoodsArray(){
   var result = {};
    var resultLength = 0;
     jQuery(".good_row").each(function(){
           var ths = jQuery(this).children(".good_content_right"); //Все поля товара
           var id = jQuery(this).attr("id");
           var count = jQuery(ths).children(".good_count").children(".good_count_input").val();
           result[""+id] = ""+count;
           resultLength++;
       });

        if(resultLength <= 0)
            return "null";
        else
            return JSON.stringify(result);
 }

 //Подсчет товаров на страницы корзины
 function CountGoodsInPage(){
   return jQuery(".good_row").length;
 }

//Удаление товара из корзины
 jQuery(".del_btn").click(function(){
   if(confirm("Удалить товар из корзины?"))
   {
      var id = jQuery(this).attr("id");
      jQuery(".good_row[id="+id+"]").fadeOut(300,function(){
          jQuery(this).remove();
          RefreshBasket();
      });
   }
 });

//Оформление заказа
jQuery("#dialog-modal-newOrder").dialog({
		  autoOpen: false,
		  width: 250,
	      modal: true
	    });
//Нажатие на кнопку оформления
jQuery(".open-orderDialog-btn").click(function(){
			jQuery( "#dialog-modal-newOrder" ).dialog("open");
			return false;
		});

//Добавление заказа
	jQuery("#addOrder-btn").click(function(){
		var url = jQuery("form[name=newOrder-form]").attr("action");

        var orderData = {};
        orderData["email"] = jQuery("#order-email").val();
        orderData["user_id"] = jQuery("#order_user_id").val();
        orderData["fio"] = jQuery("#order-fio").val();
        orderData["phone"] = jQuery("#order-phone").val();
        orderData["city"] = jQuery("#order-city").val();
        orderData["street"] = jQuery("#order-street").val();
        orderData["house"] = jQuery("#order-house").val();
        orderData["office"] = jQuery("#order-office").val();

        if(orderData["email"] != "" && orderData["fio"] != "" && orderData["phone"] != "" &&
           orderData["city"] != "" && orderData["street"] != "" && orderData["house"] != "" &&
           orderData["office"] != "")
        {
    		jQuery.ajax({
    		    url: url,
    			type: "POST",
    		    dataType : "json",
                data: {orderData:orderData},
    		    success: function (data){
    					if(data.answerCode == 0){
    					  jQuery( "#dialog-modal-newOrder" ).dialog("close");

                          jQuery.cookie("basket", "null" , {
                                         expires: 60,
                                         path: "/",
                                         secure: false
                          });
                          alert("Поздравляем! Заказ успешно оформлен.");

                           var redirectUrl = "http://"+location.host+"/boutique/orders";
                           location.replace(redirectUrl);
    					}
    		    },
    			error: function(data){
    				alert("Произошла ошибка во время ajax запроса");
    			}
    		});
        }
        else
            alert("Неверно заполнена форма");
	return false;
	});
 });