<h4>Заказы пользователей</h4>
<div class="ajax-loading" id="boutique-cats-ajax"></div>
<br/>

<?
if($orders != "" && $orders != null)
{
?>
<table class="table table-hover">
  <thead>
    <tr>
      <th>№ заказа</th>
      <th>Статус</th>
      <th>Дата</th>
      <th>ФИО</th>
      <th>Телефон</th>
      <th>Адрес</th>
      <th>Общая сумма</th>
      <th>Опции</th>
    </tr>
  </thead>
  <tbody>
      <?
        $trColors = Array("warning", "success", "info", "");

        foreach($orders as $order)
        {
          printf("<tr class='%s'>
                    <td>%s</td>
                    <td>%s</td>
                    <td>%s</td>
                    <td>%s</td>
                    <td>%s</td>
                    <td>%s</td>
                    <td>%s руб.</td>
                    <td><a href='%s'>Редактировать</a></td>
                 </tr>",
                 $trColors[$order["stat_id"] - 1],
                 $order["id"],
                 $order["stat_title"],
                 date("d.m.Y",$order["date"]),
                 $order["fio"],
                 $order["phone"],
                 "г. ".$order["city"].", ".$order["street"].", ".$order["house"].", ".$order["office"],
                 number_format($order["total_sum"], 0, ',', ' '),
                 Uri::base(false)."cp/boutique/orderedit/".$order["id"]
                 );
        }
      ?>
  </tbody>
</table>
<?
}else
   echo "Список заказов пуст";
?>