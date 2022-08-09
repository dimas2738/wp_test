<?php

global $wpdb;


if(isset($_POST['submit'])){
	$tablename = $wpdb->prefix . "departments";
	$department = $_POST['department'];
	$address = $_POST['address'];


	if($department!= ''  ){

		$check_data = $wpdb->get_results("SELECT * FROM ".$tablename." WHERE department='".$department."' ");
		if(count($check_data) == 0){
			$insert_sql = "INSERT INTO ".$tablename."(department, address)
			values('".$department."','".$address."')";
			$wpdb->query($insert_sql);
			echo "Департамент добавлен!";
		}
        elseif (count($check_data) != 0 and $check_data[0]->id_d==$_GET['edit_id'] ){
			$check_data=$check_data[0];
			$id=$check_data->id_d;
			$insert_sql = "UPDATE  $tablename 
            SET department =  '".$department."' , 
               address =  '".$address."'   
            WHERE id_d= '".$id."' ";

			$wpdb->query($insert_sql);
			echo "Департамент обновлен!";
		}
	}
}

if(isset($_GET['edit_id'])){
	$edit_id=$_GET['edit_id'];
	$tablename = $wpdb->prefix . "departments";
	$get_department = $wpdb->get_results("SELECT * FROM ".$tablename." WHERE id_d='".$edit_id."' ");


	$get_department = $get_department[0];
	$d_department = $get_department->department;
	$d_address= $get_department->address;
	$d_id_d = $get_department->id_d;


}

?>




<h1><?= isset($_GET['edit_id'])?'Изменить':'Добавить' ?> Департамент</h1>
<form method='post' action=''>
	<table>
		<tr>
			<td>Департамент</td>
			<td><input type='text' name='department' value="<?= $d_department??'' ?>"></td>
		</tr>
        <tr>
            <td>Адресс</td>
            <td><input type='text' name='address' value="<?= $d_address??'' ?>"></td>
        </tr>

			<td><input type='submit' name='submit' value=<?= isset($d_id_d)?'Изменить':'Добавить' ?>></td>
		</tr>
	</table>
</form>