<?php defined('COREPATH') or exit('No direct script access allowed'); ?>

ERROR - 2013-05-11 00:06:35 --> 1146 - Table 'wedding_db.news_cat' doesn't exist [ SELECT * FROM `news` JOIN `news_cat` ON (`news`.`id` = `news_cat`.`id`) ] in Z:\home\shop.loc\fuel\core\classes\database\mysqli\connection.php on line 243
ERROR - 2013-05-11 00:06:48 --> 1146 - Table 'wedding_db.news_cat' doesn't exist [ SELECT * FROM `news` JOIN `news_cat` ON (`news`.`cat` = `news_cat`.`id`) ] in Z:\home\shop.loc\fuel\core\classes\database\mysqli\connection.php on line 243
ERROR - 2013-05-11 00:07:59 --> 1054 - Unknown column 'all' in 'field list' [ SELECT `all`, `news_cats`.`id` AS `sdf` FROM `news` JOIN `news_cats` ON (`news`.`cat` = `news_cats`.`id`) ] in Z:\home\shop.loc\fuel\core\classes\database\mysqli\connection.php on line 243
ERROR - 2013-05-11 00:08:12 --> 1064 - You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '.`id` FROM `news` JOIN `news_cats` ON (`news`.`cat` = `news_cats`.`id`)' at line 1 [ SELECT *, `news_cats`.`id` AS `news_cats`.`id` FROM `news` JOIN `news_cats` ON (`news`.`cat` = `news_cats`.`id`) ] in Z:\home\shop.loc\fuel\core\classes\database\mysqli\connection.php on line 243
ERROR - 2013-05-11 00:08:13 --> 1064 - You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '.`id` FROM `news` JOIN `news_cats` ON (`news`.`cat` = `news_cats`.`id`)' at line 1 [ SELECT *, `news_cats`.`id` AS `news_cats`.`id` FROM `news` JOIN `news_cats` ON (`news`.`cat` = `news_cats`.`id`) ] in Z:\home\shop.loc\fuel\core\classes\database\mysqli\connection.php on line 243
ERROR - 2013-05-11 00:20:17 --> Error - Class 'News\DB' not found in Z:\home\shop.loc\fuel\app\modules\news\classes\model\news.php on line 11
ERROR - 2013-05-11 01:05:09 --> Parsing Error - syntax error, unexpected '<' in Z:\home\shop.loc\fuel\app\modules\news\views\all.php on line 2
ERROR - 2013-05-11 15:16:13 --> Parsing Error - syntax error, unexpected T_VARIABLE in Z:\home\shop.loc\fuel\app\classes\controller\cp\blog.php on line 11
ERROR - 2013-05-11 15:16:24 --> Error - Using $this when not in object context in Z:\home\shop.loc\fuel\app\classes\model\blog.php on line 18
ERROR - 2013-05-11 15:16:58 --> Error - Undefined class constant 'incBlogs' in Z:\home\shop.loc\fuel\app\classes\model\blog.php on line 18
ERROR - 2013-05-11 15:23:08 --> 8 - Undefined offset: 0 in Z:\home\shop.loc\fuel\app\views\cp\blog-article-editor.php on line 28
ERROR - 2013-05-11 15:23:12 --> 8 - Undefined offset: 1 in Z:\home\shop.loc\fuel\app\views\cp\blog-article-editor.php on line 28
ERROR - 2013-05-11 15:24:38 --> 8 - Undefined offset: 0 in Z:\home\shop.loc\fuel\app\views\cp\blog-article-editor.php on line 28
ERROR - 2013-05-11 15:26:02 --> 8 - Undefined offset: 1 in Z:\home\shop.loc\fuel\app\views\cp\blog-article-editor.php on line 28
ERROR - 2013-05-11 15:26:04 --> 8 - Undefined offset: 1 in Z:\home\shop.loc\fuel\app\views\cp\blog-article-editor.php on line 28
ERROR - 2013-05-11 15:26:23 --> Parsing Error - syntax error, unexpected ')' in Z:\home\shop.loc\fuel\app\views\cp\blog-article-editor.php on line 27
ERROR - 2013-05-11 15:26:30 --> Parsing Error - syntax error, unexpected ')' in Z:\home\shop.loc\fuel\app\views\cp\blog-article-editor.php on line 27
ERROR - 2013-05-11 15:26:54 --> 8 - Undefined offset: 0 in Z:\home\shop.loc\fuel\app\views\cp\blog-article-editor.php on line 28
ERROR - 2013-05-11 16:10:29 --> 8 - Undefined variable: pageTitle in Z:\home\shop.loc\fuel\app\views\base\controlpanel.php on line 4
ERROR - 2013-05-11 16:15:06 --> Parsing Error - syntax error, unexpected '=', expecting ')' in Z:\home\shop.loc\fuel\app\classes\controller\cp\blog.php on line 10
ERROR - 2013-05-11 16:16:15 --> Parsing Error - syntax error, unexpected T_VAR in Z:\home\shop.loc\fuel\app\classes\controller\cp\blog.php on line 9
ERROR - 2013-05-11 16:16:37 --> 2 - Missing argument 1 for Controller_Cp_Blog::action_ajaxGetCatList() in Z:\home\shop.loc\fuel\app\classes\controller\cp\blog.php on line 6
ERROR - 2013-05-11 16:17:07 --> Parsing Error - syntax error, unexpected T_VAR in Z:\home\shop.loc\fuel\app\classes\controller\cp\blog.php on line 9
ERROR - 2013-05-11 16:17:19 --> Parsing Error - syntax error, unexpected T_VAR in Z:\home\shop.loc\fuel\app\classes\controller\cp\blog.php on line 9
ERROR - 2013-05-11 16:40:49 --> 8 - Undefined variable: pageInfo in Z:\home\shop.loc\fuel\app\views\cp\blog-article-editor.php on line 42
ERROR - 2013-05-11 17:29:39 --> Error - Could not find asset: cp/blog/article-editor.js in Z:\home\shop.loc\fuel\core\classes\asset\instance.php on line 249
ERROR - 2013-05-11 17:31:39 --> Error - Could not find asset: cp/static/page-editor.js in Z:\home\shop.loc\fuel\core\classes\asset\instance.php on line 249
ERROR - 2013-05-11 17:34:07 --> Error - Could not find asset: cp/page-new.js in Z:\home\shop.loc\fuel\core\classes\asset\instance.php on line 249
ERROR - 2013-05-11 17:35:42 --> Error - Could not find asset: cp/static/page-new.js in Z:\home\shop.loc\fuel\core\classes\asset\instance.php on line 249
ERROR - 2013-05-11 17:37:18 --> Error - Could not find asset: cp/page-new.js in Z:\home\shop.loc\fuel\core\classes\asset\instance.php on line 249
ERROR - 2013-05-11 17:38:27 --> Error - Could not find asset: cp/blog/article-editor.js in Z:\home\shop.loc\fuel\core\classes\asset\instance.php on line 249
ERROR - 2013-05-11 17:38:28 --> Error - Could not find asset: cp/blog/article-editor.js in Z:\home\shop.loc\fuel\core\classes\asset\instance.php on line 249
ERROR - 2013-05-11 17:49:42 --> Error - Could not find asset: cp/blog/article-editor.js in Z:\home\shop.loc\fuel\core\classes\asset\instance.php on line 249
ERROR - 2013-05-11 17:50:52 --> Error - Could not find asset: cp/blog/article-editor.js in Z:\home\shop.loc\fuel\core\classes\asset\instance.php on line 249
ERROR - 2013-05-11 17:50:53 --> Error - Could not find asset: cp/blog/article-editor.js in Z:\home\shop.loc\fuel\core\classes\asset\instance.php on line 249
ERROR - 2013-05-11 17:51:50 --> Error - Could not find asset: cp/blog/article-editor.js in Z:\home\shop.loc\fuel\core\classes\asset\instance.php on line 249
ERROR - 2013-05-11 17:51:52 --> Error - Could not find asset: cp/blog/article-editor.js in Z:\home\shop.loc\fuel\core\classes\asset\instance.php on line 249
ERROR - 2013-05-11 17:59:37 --> Error - The requested view could not be found: cp/blog/3article-editor in Z:\home\shop.loc\fuel\core\classes\view.php on line 388
ERROR - 2013-05-11 22:15:49 --> Error - Class 'Assets' not found in Z:\home\shop.loc\fuel\app\views\cp\blog\article-editor.php on line 73
ERROR - 2013-05-11 22:21:44 --> Error - Could not find asset: cp/empty_big_small.gif in Z:\home\shop.loc\fuel\core\classes\asset\instance.php on line 249
ERROR - 2013-05-11 23:49:11 --> Parsing Error - syntax error, unexpected ')' in Z:\home\shop.loc\fuel\app\modules\news\views\all.php on line 29
ERROR - 2013-05-11 23:52:03 --> Error - Could not find asset: cp/blog/all.css in Z:\home\shop.loc\fuel\core\classes\asset\instance.php on line 249
