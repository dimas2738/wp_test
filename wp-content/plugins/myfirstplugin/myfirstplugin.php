<?php

/*
   Plugin Name: Мой первый плагин
   Plugin URI: https://tretyakov.net
   description: Простой плагин для работы с подписчиками на рассылку
   Version: 1.0.0
   Author: Александр Третьяков
   Author URI: https://tretyakov.net
*/

// Создаем таблицу
function myfirstplugin_table()
{

	global $wpdb;

	$charset_collate = $wpdb->get_charset_collate();

	$tablename = $wpdb->prefix . "myfirstplugin";

	$sql = "CREATE TABLE $tablename (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  PRIMARY KEY  (id)
  ) $charset_collate;";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);

}

register_activation_hook(__FILE__, 'myfirstplugin_table');

// Добавляем меню
function myfirstplugin_menu()
{

	add_menu_page("Мой первый плагин", "Мой первый плагин", "manage_options",
		"myfirstplugin", "displayList", "dashicons-email-alt");
	add_submenu_page("myfirstplugin", "Все подписчики", "Все подписчики", "manage_options",
		"allentries", "displayList");
	add_submenu_page("myfirstplugin", "Добавить подписчика", "Добавить подписчика",
		"manage_options", "addnewentry", "addEntry");
	remove_submenu_page('myfirstplugin','myfirstplugin');
}

add_action("admin_menu", "myfirstplugin_menu");


// Создадим функции вывода списка подписчиков и добавления нового
function displayList()
{
	include "displaylist.php";
}
//
function addEntry()
{
	include "addentry.php";
}