jQuery(document).ready(function(){
  //Основные переменные
  sliders_selector = "#slider-content ul li";  //Селектор слайдов
  previous_btn_selector = "#previous-btn";
  forward_btn_selector = "#forward-btn";
  autoplay_btn_selector = "#autoplay_btn";
  autoplay_status = false;
  autoplay_intervar = null; //id интервала
  time = 1800; // время скрытия/показа картинки
  current_slide_index = 0;  //Номер текущего слайда
  total_slides = jQuery(sliders_selector).length;  //Общее кол-во слайдов
  enable_change = false; // Разрешить смену картинок
  //Сгенерировать кнопки-миниатюры
    for(i = 0; i < total_slides; i++)
    {
        jQuery("#slider-mini").append("<div class='mini-btn' id='"+i+"'></div>");
    }
    jQuery("#slider-mini").append("<div style='clear:both;'></div>");
  //Конец генерации мини кнопок

  //Показать начальный слайд
  jQuery(sliders_selector).eq(current_slide_index).css({'opacity':'1.0', 'z-index': '2'});
  ChangeMini(current_slide_index); //Выделить миниатюру начального слайда

  //Разрешить слайдинг после полной загрузки первой картинки
  jQuery(sliders_selector+" img").eq(current_slide_index).load(function(){
    enable_change = true;
  });

  //Показывает новые слайд, скрывает старый, меняет переменную "текущий слайд"
  function HideAndShow(show_slide_index, time)
  {
      if(show_slide_index == current_slide_index) return;
      enable_change = false;

      hide_slide = jQuery(sliders_selector).eq(current_slide_index);
      show_slide = jQuery(sliders_selector).eq(show_slide_index);

      ChangeMini(show_slide_index); // Выделить новую миниатюру
      show_slide.animate({'opacity':'1.0', 'z-index': '2'}, time);
      hide_slide.animate({'opacity':'0.0', 'z-index': '1'}, time, function(){

        current_slide_index = show_slide_index;
        enable_change  = true;
      });
  }

  //Выделение миниатюры текущей картинки
  function ChangeMini(mini_index){
    jQuery(".mini-selected").removeClass("mini-selected");
    jQuery(".mini-btn[id="+mini_index+"]").addClass("mini-selected");
  }

  //Показывает стрелки
  function ShowArrows(){
      jQuery(previous_btn_selector+", "+forward_btn_selector).css({'opacity':'1.0'});
  }

  //Скрывает стрелки
  function HideArrows(){
      jQuery(previous_btn_selector+", "+forward_btn_selector).css({'opacity':'0.0'});
  }

  
  //Наведение на блок с большой картинкой
  jQuery("#slider-content").mouseenter(function(){
    ShowArrows();
  });
   //Уход мыши с блока с большой картинкой
  jQuery("#slider-content").mouseleave(function(){
    HideArrows();
  });

////Слайдшоу
    jQuery(autoplay_btn_selector).click(function(){
        
        if(autoplay_status)
        {
            clearInterval(autoplay_intervar);
            jQuery(autoplay_btn_selector).removeClass("autoplay_btn_play");
            autoplay_status = false;
        }
        else
        {
             autoplay_status = true;
             jQuery(autoplay_btn_selector).addClass("autoplay_btn_play"); 
             autoplay_intervar = setInterval(function(){
                 jQuery(forward_btn_selector).trigger('click');
             },3500);
        }
    });

  //Клик "вперед"
  jQuery(forward_btn_selector).click(function()
  {
    if(enable_change == false) return;

    forward_slide_index = current_slide_index + 1;

    if(forward_slide_index > total_slides - 1)
      forward_slide_index = 0;
  
    HideAndShow(forward_slide_index, time);
  });



  //Клик "назад"
  jQuery(previous_btn_selector).click(function()
  {
    if(enable_change == false) return;

    previous_slide_index = current_slide_index - 1;

    if(previous_slide_index < 0)
        previous_slide_index = total_slides - 1;

    HideAndShow(previous_slide_index, time);
    
  });

  //Клик по миниатюре-кнопке
  jQuery(".mini-btn").click(function()
  {
    if(enable_change == false) return;
    new_slide_index = parseInt(jQuery(this).attr("id"), 10);
    HideAndShow(new_slide_index, time);
  });

});