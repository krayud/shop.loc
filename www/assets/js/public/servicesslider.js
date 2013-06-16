jQuery(document).ready(function(){

	var sliderBlockSize = 240;
	var countSlidersServices = jQuery('#ld-services-slider .ldslide').size();
	var slidersOnVisibility = 4;
	var currentSlideServices = countSlidersServices - slidersOnVisibility;
	var directionServices = "left"; // Начинать прокручивать влево
	var sliderSpeed = 2400;
	var sliderInterval = 7000;

	
	jQuery("#ld-services-slider .ldslides").css("width",sliderBlockSize*countSlidersServices+"px");
	//jQuery("#ld-services-slider .ldslides").css("marginLeft", -240+"px");
	ServicesRewindSlideTo(currentSlideServices, 0);
	function startAutoSlideServices(){
		if(countSlidersServices > slidersOnVisibility)
			return setInterval(ServicesSlide, sliderInterval);
	}

	function ServicesRewindSlideTo(toSlide, speed){
		newMargin = toSlide * sliderBlockSize * -1;
		jQuery("#ld-services-slider .ldslides").animate({"marginLeft" : newMargin+"px"}, speed);
	}

	function ServicesSlide(){
		if(directionServices == "left" && currentSlideServices == countSlidersServices - slidersOnVisibility){
			directionServices = "right";

		}
		else if(directionServices == "right" &&  currentSlideServices == 0)
			directionServices = "left";

		if(directionServices == "left")
			newSlide = ++currentSlideServices;
		else
			newSlide = --currentSlideServices;

		ServicesRewindSlideTo(newSlide, sliderSpeed);
		
	}

	var ServicesSliderIntervar = startAutoSlideServices();

	//Остановка при наведении
	jQuery("#services-slider-block").mouseenter(function(){
		clearInterval(ServicesSliderIntervar);
        //showHideButton(true);
	});

	//Возобновление при отводе курсора
	jQuery("#services-slider-block").mouseleave(function(){
		ServicesSliderIntervar = startAutoSlideServices();
        // showHideButton(false);
	});
});