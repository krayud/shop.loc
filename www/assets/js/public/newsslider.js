jQuery(document).ready(function(){

	var sliderBlockSize = 240;
	var countSliders = jQuery('#ldslides > .ldslide').size();
	var slidersOnVisibility = 4;
	var currentSlide = 0;
	var direction = "left"; // Начинать прокручивать влево
	var sliderSpeed = 2000;
	var sliderInterval = 7000;


	function startAutoSlide(){
		if(countSliders > slidersOnVisibility)
			return setInterval(newsSlide, sliderInterval);
	}

	function rewindSlideTo(toSlide){
		newMargin = toSlide * sliderBlockSize * -1;
		jQuery("#ld-news-slider #ldslides").animate({"marginLeft" : newMargin+"px"}, sliderSpeed);
	}

	function newsSlide(){
		if(direction == "left" && currentSlide == countSliders - slidersOnVisibility){
			direction = "right";

		}
		else if(direction == "right" &&  currentSlide == 0)
			direction = "left";

		if(direction == "left")
			newSlide = ++currentSlide;
		else
			newSlide = --currentSlide;

		rewindSlideTo(newSlide);
	}

	var newsSliderIntervar = startAutoSlide();

    /*
    //изменение стрелок при наведении
    jQuery("#news-slide-back, #news-slide-forward").mouseenter(function(){
         jQuery(this).css("backgroundPosition","0px 0px");
    });
     //изменение стрелок при уходе мыши
     jQuery("#news-slide-back, #news-slide-forward").mouseleave(function(){
         jQuery(this).css("backgroundPosition","-50px 0px");
    });


	//нажатие назад
	jQuery("#news-slide-back").click(function(){
		if(currentSlide > 0){
			clearInterval(newsSliderIntervar);
			rewindSlideTo(--currentSlide);
			newsSliderIntervar = startAutoSlide();
		}

	});
	//нажатие вперед
   	jQuery("#news-slide-forward").click(function(){

		if(currentSlide < countSliders - slidersOnVisibility){

			clearInterval(newsSliderIntervar);

			rewindSlideTo(++currentSlide);

			newsSliderIntervar = startAutoSlide();

		}
			
	});
     */

	//Остановка при наведении
	jQuery("#news-slider-block").mouseenter(function(){
		clearInterval(newsSliderIntervar);
        //showHideButton(true);
	});

	//Возобновление при отводе курсора
	jQuery("#news-slider-block").mouseleave(function(){
		newsSliderIntervar = startAutoSlide();
        // showHideButton(false);
	});
});