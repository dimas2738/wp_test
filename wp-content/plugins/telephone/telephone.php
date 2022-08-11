<?php

/*
Plugin Name: Telephone

Description:telephone numbers.
Author: DL
Version: 1

*/

function workers_table() {
	global $wpdb;

	$charset_collate = $wpdb->get_charset_collate();

	$tablename = $wpdb->prefix . "workers";

	$sql = "CREATE TABLE IF NOT EXISTS  $tablename (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  midlname varchar(255) NOT NULL,
  surname varchar(255) NOT NULL,
  job_title varchar(255) NOT NULL,
  short_number varchar(255) NOT NULL,
  long_number varchar(255) NOT NULL,
  department_id int(11) NOT NULL,
  room int(11) NOT NULL,
  PRIMARY KEY  (id)
  ) $charset_collate;";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);

}

function department_table() {
	global $wpdb;

	$charset_collate = $wpdb->get_charset_collate();

	$tablename = $wpdb->prefix . "departments";

	$sql = "CREATE TABLE IF NOT EXISTS $tablename (
  id_d int(11) NOT NULL AUTO_INCREMENT,
  department varchar(255) NOT NULL,
  address varchar(255) NOT NULL,
  PRIMARY KEY  (id_d)
  ) $charset_collate;";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);

}


add_filter('template_include', 'function_name');
function function_name( $template ) {
	if ( is_page('page-slug') ){
		return wp_normalize_path( WP_PLUGIN_DIR ) . '/telephone/frontend/page-slug.php';
	}
	return $template;
}

register_activation_hook(__FILE__, 'workers_table');
register_activation_hook(__FILE__, 'department_table');

// Добавляем меню
function myplugin_menu()
{

	add_menu_page("Мой плагин", "Мой плагин", "manage_options",
		"myplugin", "displayList", "dashicons-email-alt");
	add_submenu_page("myplugin", "Добавить работника", "Добавить работника",
		"manage_options", "addnewworker", "addWorker");
	add_submenu_page("myplugin", "Все работники", "Все работники", "manage_options",
		"allentries", "displayList");
	add_submenu_page("myplugin", "Добавить департамент", "Добавить департамент",
		"manage_options", "addnewdepartment", "addDepartment");
	add_submenu_page("myplugin", "Все департаменты", "Все департаменты",
		"manage_options", "alldepartments", "allDepartments");


	remove_submenu_page('myplugin','myplugin');
}

add_action("admin_menu", "myplugin_menu");


 function displayList()
{
	include "display_telephones.php";
}

function addWorker()
{
	include "add_worker.php";
}
function addDepartment()
{
	include "add_department.php";
}
function allDepartments()
{
	include "display_departments.php";
}

