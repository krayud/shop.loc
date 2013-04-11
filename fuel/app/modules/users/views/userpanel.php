<div>
	<?=$userInfo["email"];?>
	[<a href="#">Выйти</a>]
	<? if($userInfo["level"] >= 2) {?>
		| <a href="#">Панель управления</a>
	<?}?>
	 | <a href="#">Личный кабинет</a>
	 | <a href="#">Че хочу</a>
</div>    