<?php

class Controller_Cp_Blog extends Controller_Cp_Main
{

// Ajax запрос на генерация списка категорий в разделе Input::param("section")
public function action_ajaxGetCatList()
{
	if(Input::is_ajax()){
		$section = Input::param("section");
		$cats = Model_Blog::GetCatsInSection($section);
		$result = array("code" => 0, "catList" => $cats);
		return json_encode($result);
	}
	else
		$this->ShowErrorPage("404");
}

// Список всех записей
	public function action_list()
	{
        $this->template->pageTitle = "Все записи блога";
		$articles = Model_Blog::GetArticlesList();
		$this->template->pageContent = View::forge("cp/blog/articles-list", array("articles" => $articles));
	}

// Редактирование категорий блога
	public function action_cats()
	{
	    array_push($this->_extraJs, "cp/blog/ajax-cat-loader"
									);
        $this->template->pageTitle = "Категории и резделы блога";
		$blogSections = Model_Blog::GetBlogSections();
		$this->template->pageContent = View::forge("cp/blog/cats-editor",array("blogSections" =>$blogSections));
	}

// Форма добавления новой записи в блог
	public function action_new()
	{
		array_push($this->_extraJs, "lduploader/lduploader",
									"tiny_mce/tiny_mce",
									"tiny_mce/common-editor",
									"cp/blog/ajax-cat-loader",
									"cp/blog/article-send-form");

		array_push($this->_extraCss, "cp/blog/article-editor");

		$this->template->pageTitle = "Добавить запись в блог";
		$blogSections = Model_Blog::GetBlogSections();
		$this->template->pageContent = View::forge("cp/blog/article-editor",
													array("blogSections" => $blogSections));
	}

// Форма редактирования записи в блоге
	public function action_edit($section = null, $articleId = null)
	{
	    if($articleId === null || $section === null)
			$this->ShowErrorPage("404");

         $articleInfo = Model_Blog::GetArticleBySectionAndId($section, $articleId);
         $articleInfo[0]["section"] = $section; // Добавляет раздел к остальной информации о записи
         if($articleInfo == null)
			$this->ShowErrorPage("404");

		array_push($this->_extraJs, "lduploader/lduploader",
									"tiny_mce/tiny_mce",
									"tiny_mce/common-editor",
									"cp/blog/ajax-cat-loader",
									"cp/blog/article-send-form");

		array_push($this->_extraCss, "cp/blog/article-editor");

		$this->template->pageTitle = "Редактирование записи в блоге";

		$blogSections = Model_Blog::GetBlogSections();
        $cats = Model_Blog::GetCatsInSection($section);
		$this->template->pageContent = View::forge("cp/blog/article-editor",
													array("blogSections" => $blogSections,
                                                            "articleInfo" => $articleInfo,
                                                            "cats" => $cats));
	}

/**
* Добавление новой записи в блог через ajax
*
*/
	public function action_add(){
		if(Input::is_ajax()){
			$resultJSON = null;


				$articleData["img"] = $this->TrimAndSqlEscape(Input::param("img"));
				$articleData["editId"] = $this->TrimAndSqlEscape(Input::param("editId"));
				$articleData["section"] = $this->TrimAndSqlEscape(Input::param("section"));
				$articleData["cat"] = $this->TrimAndSqlEscape(Input::param("cat"));
				$articleData["display_in_mini_block"] = $this->TrimAndSqlEscape(Input::param("display_in_mini_block"));
				$articleData["title"] = $this->TrimAndSqlEscape(Input::param("title"));
				$articleData["description"] = $this->TrimAndSqlEscape(Input::param("description"));
				$articleData["text"] = $this->TrimAndSqlEscape(Input::param("text"));

				$resultJSON = Model_Blog::AddNewArticle($articleData);

			return json_encode($resultJSON);
			exit();
		}

		$this->ShowErrorPage("404");
	}

/**
* Удаление записи в блоге через ajax
*
*/
	public function action_delete($section = null, $id = null){
		if(Input::is_ajax()){
			$resultJSON = null;

            if($section == null || $id == null)
                $this->ShowErrorPage("404");

			$resultJSON = Model_Blog::DeleteArticle($section, $id);
			return json_encode($resultJSON);
			exit();
		}
        else
		$this->ShowErrorPage("404");
	}

/**
*
* Обновление записи в блоге
*
*/
	public function action_update(){
		if(Input::is_ajax()){
			$resultJSON = null;
                $pageData["editId"] = $this->TrimAndSqlEscape(Input::param("editId"));
			    $articleData["img"] = $this->TrimAndSqlEscape(Input::param("img"));
				$articleData["editId"] = $this->TrimAndSqlEscape(Input::param("editId"));
				$articleData["section"] = $this->TrimAndSqlEscape(Input::param("section"));
				$articleData["cat"] = $this->TrimAndSqlEscape(Input::param("cat"));
				$articleData["display_in_mini_block"] = $this->TrimAndSqlEscape(Input::param("display_in_mini_block"));
				$articleData["title"] = $this->TrimAndSqlEscape(Input::param("title"));
				$articleData["description"] = $this->TrimAndSqlEscape(Input::param("description"));
				$articleData["text"] = $this->TrimAndSqlEscape(Input::param("text"));

				$resultJSON = Model_Blog::UpdateArticle($articleData);

			return json_encode($resultJSON);
			exit();
		}

		$this->ShowErrorPage("404");
	}

/**
* Добавление категории в раздел блога
*
*/
	public function action_addcat(){
		if(Input::is_ajax()){
			$resultJSON = null;
            $section = Input::param("section");
            $newCatname =  Input::param("newCatname");
			$resultJSON = Model_Blog::AddCat($section, $newCatname);
			return json_encode($resultJSON);
			exit();
		}
        else
		$this->ShowErrorPage("404");
	}

/**
* Удаление категорий в разделе блога
*
*/
	public function action_deletecats(){
		if(Input::is_ajax()){
			$resultJSON = null;
            $section = Input::param("section");
            $cat =  Input::param("cat");
			$resultJSON = Model_Blog::DeleteCats($section, $cat);
			return json_encode($resultJSON);
			exit();
		}
        else
		$this->ShowErrorPage("404");
	}

}
