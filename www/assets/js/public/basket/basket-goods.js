jQuery(document).ready(function(){

    jQuery(".goods-basket-btn").click(function(){
      var goodId = jQuery(this).attr("id");
      var oldCookie = jQuery.cookie("basket");
      var oldArray = JSON.parse(oldCookie);

      var addCount = 1;   // кол-во добавляемого товара
      var newGoodCount = 0; // Кол-во товара в корзине вместе с новым

      if(oldArray == null)//Если корзина была пустой
      {
        oldArray = {};
        oldArray[""+goodId] = ""+addCount;
      }
      else
      {
          var oldCount = oldArray[""+goodId]; // Кол-во этого товара в корзине
          if(oldCount == undefined)
            newGoodCount = addCount;
          else
            newGoodCount = parseInt(oldCount) + addCount;

          oldArray[""+goodId] = ""+newGoodCount;
      }

      var newList = JSON.stringify(oldArray);
      jQuery.cookie("basket",newList, {
                                       expires: 60,
                                       path: "/",
                                       secure: false
        });

    var newGoodsCount = CountGoodsFromCookie();
    jQuery(".total_goods_count_basket").text(newGoodsCount);

    //TODO: Сделать уведомление
    alert("Товар добавлен в корзину");
    });

});