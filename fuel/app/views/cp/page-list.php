<h4>Список всех страниц</h4>
<table class="table table-bordered table-hover">
	<thead>
    <tr>
      <th>URI</th>
      <th>Заголовок</th>
	  <th>Отображается в меню</th>
	  <th>Настройки</th>
    </tr>
  </thead>
  <tbody>
  <?
foreach($pages as $page){
	echo "<tr>";
      echo "<td>".$page["uri"]."</td>";
	  echo "<td>".$page["title"]."</td>";
	  	if($page["display_link"] != 0)
	  		echo "<td>Да</td>";
		else
			echo "<td>Нет</td>";
		echo "<td><a href='".Uri::base(false)."cp/page/edit/".$page["id"]."'>Изменить</a></td>";
	echo "</tr>";
}
	
?>
  </tbody>
</table>