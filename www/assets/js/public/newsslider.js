jQuery(document).ready(function(){

	var sliderBlockSize = 240;
	var countSliders = jQuery('#ld-news-slider .ldslide').size();
	var slidersOnVisibility = 4;
	var currentSlide = 0;
	var direction = "left"; // Начинать прокручивать влево
	var sliderSpeed = 2400;
	var sliderInterval = 7000;


	function startAutoSlide(){
		if(countSliders > slidersOnVisibility)
			return setInterval(newsSlide, sliderInterval);
	}

	function rewindSlideTo(toSlide){
		newMargin = toSlide * sliderBlockSize * -1;
		jQuery("#ld-news-slider .ldslides").animate({"marginLeft" : newMargin+"px"}, sliderSpeed);
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