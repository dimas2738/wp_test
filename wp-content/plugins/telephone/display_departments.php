<?php
global $wpdb;

$tablename = $wpdb->prefix."departments";


if(isset($_GET['delete_id'])){
    $delid = $_GET['delete_id'];

	$wpdb->query("DELETE FROM ".$tablename." WHERE id_d=".$delid);
}
?>
<h1>Все Департаменты</h1>

<table width='100%' border='1' style='border-collapse: collapse;'>
	<tr>
		<th>№</th>
		<th>Департамент</th>
		<th>Адресс</th>



		<th>&nbsp;</th>
	</tr>
	<?php

	$entriesList = $wpdb->get_results("SELECT *
FROM $tablename ");
	if(count($entriesList) > 0){
		$count = 1;
//        var_dump($entriesList);
		foreach($entriesList as $entry){
			$id = $entry->id_d;
			$department = $entry->department;
			$address= $entry->address;



			echo "<tr>
      <td>".$count."</td>
      <td>".$department."</td>
      <td>".$address."</td>
       

      <td><a href='?page=alldepartments&delete_id=".$id."'>Удалить</a></td>
      </tr>
      ";
			$count++;
		}
	}else{
		echo "<tr><td colspan='5'>Нет Департаментов</td></tr>";
	}
	?>
</table>