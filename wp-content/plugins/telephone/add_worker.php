<?php

global $wpdb;

$tablename1='wp_departments';
$departments = $wpdb->get_results("SELECT * FROM $tablename1");




// Добавляем подписчика
if(isset($_POST['submit'])){
	$tablename = $wpdb->prefix . "workers";
	$name = $_POST['name'];
	$midlname= $_POST['midlname'];
	$surname = $_POST['surname'];
	$job_title= $_POST['job_title'];
	$short_number= $_POST['short_number'];
	$long_number= $_POST['long_number'];
	$department_id= $_POST['department_id'];
    $room=$_POST['room'];



	if($name != '' && $surname != '' && $midlname != ''
	   && $job_title != '' && $short_number != '' && $long_number != ''
	   && $department_id != '' ){
		// Проверяем по полю email есть ли такой подписчик
		$check_data = $wpdb->get_results("SELECT * FROM ".$tablename." WHERE surname='".$surname."'
		AND name='".$name."' AND midlname='".$midlname."' 
");

		if(count($check_data) == 0){
			$insert_sql = "INSERT INTO ".$tablename."(name,midlname,surname,
			job_title,short_number,long_number,department_id,room)
			values('".$name."','".$midlname."','".$surname."','".$job_title."'
			,'".$short_number."','".$long_number."','".$department_id."','".$room."') ";
			$wpdb->query($insert_sql);
			echo "Работник добавлен!";
		}
		elseif (count($check_data) != 0 and $check_data[0]->id==$_GET['edit_id'] ){
	        $check_data=$check_data[0];
            $id=$check_data->id;
 	        $insert_sql = "UPDATE ".$tablename."
            SET name = ".$name.", 
                midlname = ".$name.", 
                surname = ".$surname.", 
                job_title = ".$job_title.", 
                short_number = ".$short_number.", 
                long_number = ".$long_number.", 
                department_id = ".$department_id.", 
                room = ".$room."
            WHERE id=".$id."; ";
	        $wpdb->query($insert_sql);
	        echo "Работник обновлен!";
        }
	}
}

if(isset($_GET['edit_id'])){
    $edit_id=$_GET['edit_id'];
	$tablename = $wpdb->prefix . "workers";
    $get_worker = $wpdb->get_results("SELECT * FROM ".$tablename." WHERE id='".$edit_id."' ");
	$get_worker = $get_worker[0];
	$w_name = $get_worker->name;
	$w_midlname= $get_worker->midlname;
	$w_surname = $get_worker->surname;
	$w_job_title= $get_worker->job_title;
	$w_short_number= $get_worker->short_number;
	$w_long_number= $get_worker->long_number;
	$w_department_id= $get_worker->department_id;
	$w_room=$get_worker->room;

}

?>

<h1><?= isset($_GET['edit_id'])?'Изменить':'Добавить' ?> Работника</h1>
<form method='post' action=''>
	<table>
		<tr>
			<td>Фамилия</td>
			<td><input type='text' name='surname' value="<?= $w_surname??'' ?>"></td>
		</tr>
		<tr>
			<td>Имя</td>
			<td><input type='text' name='name' value="<?= $w_name??'' ?>"></td>
		</tr>
		<tr>
			<td>Отчество</td>
			<td><input type='text' name='midlname' value="<?= $w_midlname??'' ?>"></td>
		</tr>
		<tr>
			<td>Должность</td>
			<td><input type='text' name='job_title' value="<?= $w_job_title??'' ?>"></td>
		</tr>
		<tr>
			<td>Телефон</td>
			<td><input type='text' name='long_number' value="<?= $w_long_number??'' ?>"></td>
		</tr>
		<tr>
			<td>Телефон Внутренний</td>
			<td><input type='text' name='short_number' value="<?= $w_short_number??'' ?>"></td>
		</tr>
		<tr>
			<td>Отдел</td>
			<td> <form  method="post">
                    <select name="department_id"> <!--Supplement an id here instead of using 'name'-->
	                    <?php foreach ($departments as $department) :?>
                        <option value="<?= $department->id_d?>"><?= $department->department?></option>
		                    <?php endforeach;?>
                    </select>
                </form></td>
		</tr>
        <tr>
            <td>Кабинет</td>
            <td><input type='text' name='room' value="<?= $w_room??'' ?>"></td>
        </tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type='submit' name='submit' value=<?= isset($w_room)?'Изменить':'Добавить' ?>></td>
		</tr>
	</table>


</form>