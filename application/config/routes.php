<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'Users/login';
$route['tasks'] ='Tasks/index';

$route['tasks/create'] = 'tasks/create';
//$route['tasks/delete/(:num)'] = 'tasks/delete/$1'; //rather create? was mistype

// //instead this?
// $route['tasks/create'] = 'tasks/create';   // Für neue Einträge
// $route['tasks/update/(:num)'] = 'tasks/update/$1'; // Für das Aktualisieren bestehender Einträge

