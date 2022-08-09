<?php

global $wpdb;
$tablename = $wpdb->prefix."myfirstplugin";

// Удаляем подписчика
if(isset($_GET['delete_id'])){
	$delid = $_GET['delete_id'];
	$wpdb->query("DELETE FROM ".$tablename." WHERE id=".$delid);
}
?>
<h1>Все подписчики</h1>

<table width='100%' border='1' style='border-collapse: collapse;'>
    <tr>
        <th>№</th>
        <th>Имя</th>
        <th>Email</th>
        <th>&nbsp;</th>
    </tr>
	<?php
	// Получаем записи и, если они есть, выводим
	$entriesList = $wpdb->get_results("SELECT * FROM ".$tablename." order by id desc");
	if(count($entriesList) > 0){
		$count = 1;
		foreach($entriesList as $entry){
			$id = $entry->id;
			$name = $entry->name;
			$email = $entry->email;

			echo "<tr>
      <td>".$count."</td>
      <td>".$name."</td>
      <td>".$email."</td>
      <td><a href='?page=allentries&delete_id=".$id."'>Удалить</a></td>
      </tr>
      ";
			$count++;
		}
	}else{
		echo "<tr><td colspan='5'>Нет подписчиков</td></tr>";
	}
	?>
</table>