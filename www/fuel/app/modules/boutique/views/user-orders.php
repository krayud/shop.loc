<style>

.user-orders-table{
  color: #555;
}

.user-orders-table td{
    padding:3px 15px 3px 15px;
    font-size: 14px;
}

.user-orders-table th{
    font-size: 12px;
    font-weight: bold;
}

.user-orders-table tr{
    border-bottom: 1px solid #bbb;
}

.user-orders-table tbody tr:hover{
    background-color: #dedede;
}
</style>


<h1 style='color:#444'>Мои заказы</h1>
<br/>
<?
if($orders != "" && $orders != null)
{
?>
<table class="user-orders-table">
  <thead>
    <tr>
      <th>№ заказа</th>
      <th>Статус</th>
      <th>Дата</th>
      <th>Телефон</th>
      <th>Общая сумма</th>
      <th>Опции</th>
    </tr>
  </thead>
  <tbody>
      <?
        foreach($orders as $order)
        {
          printf("<tr>
                    <td>%s</td>
                    <td>%s</td>
                    <td>%s</td>
                    <td>%s</td>
                    <td>%s руб.</td>
                    <td><a href='%s'>Подробнее</a></td>
                 </tr>",
                 $order["id"],
                 $order["stat_title"],
                 date("d.m.Y",$order["date"]),
                 $order["phone"],
                 number_format($order["total_sum"], 0, ',', ' '),
                 Uri::base(false)."boutique/orders/".$order["id"]
                 );
        }
      ?>
  </tbody>
</table>
<?
}else
   echo "<p>Список заказов пуст</p>";
?>