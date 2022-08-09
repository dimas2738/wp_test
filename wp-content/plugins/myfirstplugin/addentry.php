<?php

global $wpdb;

// Добавляем подписчика
if(isset($_POST['submit'])){

	$name = $_POST['name'];
	$email = $_POST['email'];
	$tablename = $wpdb->prefix."myfirstplugin";

	if($name != '' && $email != ''){
		// Проверяем по полю email есть ли такой подписчик
		$check_data = $wpdb->get_results("SELECT * FROM ".$tablename." WHERE email='".$email."' ");
		if(count($check_data) == 0){
			$insert_sql = "INSERT INTO ".$tablename."(name,email) values('".$name."','".$email."') ";
			$wpdb->query($insert_sql);
			echo "Подписчик добавлен!";
		}
	}
}

?>
<h1>Добавить подписчика</h1>
<form method='post' action=''>
	<table>
		<tr>
			<td>Имя</td>
			<td><input type='text' name='name'></td>
		</tr>
		<tr>
			<td>Email</td>
			<td><input type='text' name='email'></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type='submit' name='submit' value='Добавить'></td>
		</tr>
	</table>
</form>