<?php
class Controller_Base_Public extends Controller_Base_Main
{
	public $template = 'base/public';
	
	public function before(){
		parent::before();
		array_push($this->_extraCss, 
						"public/91ea7606", "public/7431cbeb", 
						"public/main",
						"public/newsslider",
						"jquery/jquery-ui", 
						"modules/users/forms",
						"modules/questions/form",
						"modules/polling/results"
						);//Стили только для публичных страниц
						
		array_push($this->_extraJs, "public/4379948d", 
									"public/newsslider", 
									"public/servicesslider",
									"jquery/jquery-ui");//Скрипты только для публичных страниц
		
		//Определение блока пользователя для всех публичных страниц

		$links = Model_Static::GetStaticPagesList("visible");
		$this->template->static_links_block = View::forge("public/helpers/static-pages-links", array("links" => $links));
		$this->template->static_links_footer_block = View::forge("public/helpers/static-pages-links-footer", array("links" => $links));
		$this->template->userPanel = $this->_modules["users"]->GetUserPanel();
               
		Module::load('news');
        Module::load('trends');
        Module::load('reviews');
		Module::load("questions");
		Module::load("polling");
		
		$this->template->questionForm = \Questions\Model_Questions::GetQuestionForm($this->_userInfo);
		$sliderArticles = \News\Model_News::GetArticlesToNewsSlider();
        $trendsSideBarArticle = \Trends\Model_Trends::GetArticleToTrendsMiniBlock();
        $reviewsSideBarArticle = \Reviews\Model_Reviews::GetArticleToReviewsMiniBlock();
        $this->template->newsSlider = View::forge("public/news/slider", array("articles" => $sliderArticles));
        $this->template->trendsSideBar = View::forge("public/trends/sidebar-block", array("article" => $trendsSideBarArticle),false);
		 $this->template->polling = \Polling\Model_Polling::GetSidebarBlock($this->_userInfo);
        $this->template->reviewsSideBar = View::forge("public/reviews/sidebar-block", array("article" => $reviewsSideBarArticle),false);
	}
}