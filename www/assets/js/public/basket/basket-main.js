//Пересчет и обновление кол-ва товаров в мини блоке корзины
 function RefreshMiniBasket()
 {
    var newGoodsCount = CountGoodsFromCookie();
   jQuery(".total_goods_count_basket").text(newGoodsCount);
 }

//Пересчет кол-ва товаров в мини корзине (виджите) из значений кук
 function CountGoodsFromCookie()
 {
    var oldCookie = jQuery.cookie("basket");
    var oldArray = JSON.parse(oldCookie, true);

    var lent = 0;
    for(var key in oldArray){
      lent += parseInt(oldArray[key]);
    }
    return lent;
 }
