<?php

global $wpdb;
$tablename  = $wpdb->prefix . "workers";
$tablename2 = $wpdb->prefix . "departments";


if ( isset( $_GET['delete_id'] ) ) {
	$delid = $_GET['delete_id'];
	$wpdb->query( "DELETE FROM " . $tablename . " WHERE id=" . $delid );
}

if ( isset( $_POST['find'] ) ) {
	$data = $_POST['find'];
    $data=explode(" ", $data);


    if (count($data)==1){
        $sql="SELECT * FROM $tablename
    LEFT JOIN $tablename2
    on $tablename.department_id=$tablename2.id_d
    WHERE  $tablename.job_title= '$data[0]'
       OR  $tablename2.department='$data[0]'
       OR  $tablename.name='$data[0]'
       OR  $tablename.surname='$data[0]'
       OR  $tablename.midlname='$data[0]'";


	    $res=$wpdb->get_results( $sql);


    }
	echo("<table width='100%' border='1' style='border-collapse: collapse; margin-top: 20px' >");
    foreach ($res as $i){
	    $short_number = is_user_logged_in()?$i->short_number:'доступно только зарегестрированным пользователям';
        echo(" 
 <tr>
  <td>" . $i->department . "</td>
      <td>" . $i->name . "</td>
      <td>" . $i->midlname . "</td>
      <td>" . $i->surname . "</td>
      <td>" . $i->job_title . "</td>
      <td>" . $i->long_number . "</td>
       <td>" .  $short_number . "</td>
        <td>" . $i->room . "</td>
      <td><a href='?page=allentries&delete_id=" . $i->id . "'>Удалить</a></td>
      <td><a href='?page=addnewworker&edit_id=" . $i->id . "'>Редактировать</a></td></tr> "
        );

    }
	echo ('</table>');
    die();
}


?>
<form method='post' action='' style="margin-top: 10px;margin-right: 10px; display: flex; justify-content:flex-end">

    <input type='text' name='find' placeholder="Отдел/Должность/Фамилия">
    <input type='submit' name='submit' value='Поиск'>
</form>



<h1>Все работники</h1>
<table width='100%' border='1' style='border-collapse: collapse;'>
    <tr>

        <th>Имя</th>
        <th>Фамилия</th>
        <th>Отчество</th>
        <th>Должность</th>
        <th>Телефон</th>
        <th>Телефон Внутренний</th>
        <th>Кабинет</th>
        <th></th>
        <th></th>
    </tr>

	<?php
	$departments = $wpdb->get_results( "SELECT * FROM $tablename2" );

	foreach ( $departments as $department ) {
		echo( "<tr>
<td colspan='1'><b>$department->department</b></td>
<td colspan='7'>$department->address</td>
<td colspan='4'><a href='?page=addnewdepartment&edit_id=" . $department->id_d . "'>Редактировать</a></td>
</tr>" );
		$worker = $wpdb->get_results( "SELECT *
    FROM $tablename WHERE department_id=" . $department->id_d );

		if ( count( $worker ) > 0 ) {
			foreach ( $worker as $w ) {
				$id           = $w->id;
				$name         = $w->name;
				$midlname     = $w->midlname;
				$surname      = $w->surname;
				$job_title    = $w->job_title;
				$short_number = is_user_logged_in()?$w->short_number:'доступно только зарегестрированным пользователям';
				$long_number  = $w->long_number;
				$room         = $w->room;
				echo( "
      
     <tr>
      <td>" . $name . "</td>
      <td>" . $midlname . "</td>
      <td>" . $surname . "</td>
      <td>" . $job_title . "</td>
      <td>" . $long_number . "</td>
       <td>" . $short_number . "</td>
        <td>" . $room . "</td>
      <td><a href='?page=allentries&delete_id=" . $id . "'>Удалить</a></td>
      <td><a href='?page=addnewworker&edit_id=" . $id . "'>Редактировать</a></td></tr>
      " );


			}
		} else {
			echo "<tr><td colspan='9'>Нет Cотрудников</td></tr>";
		}
	}
	?>
</table>