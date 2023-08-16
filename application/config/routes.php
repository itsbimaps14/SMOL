<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'auth/landing';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Route for QC
$folder_qc = 'qc';
$route['qc'] = "$folder_qc/qc";
	// Route for QC Belum Analisa
	$route['belum_analisa'] = "$folder_qc/belum_analisa";
	$route['belum_analisa/proses'] = "$folder_qc/belum_analisa/proses";
	$route['belum_analisa/proses/(:num)'] = "$folder_qc/belum_analisa/proses/$1";
	$route['belum_analisa/delete'] = "$folder_qc/belum_analisa/delete";
	$route['belum_analisa/delete/(:num)'] = "$folder_qc/belum_analisa/delete/$1";
	// Route for Analisa QC
	$route['analisa_qc'] = "$folder_qc/analisa_qc";
	$route['analisa_qc/proses'] = "$folder_qc/analisa_qc/proses";
	$route['analisa_qc/proses/(:num)'] = "$folder_qc/analisa_qc/proses/$1";
	$route['analisa_qc/delete'] = "$folder_qc/analisa_qc/delete";
	$route['analisa_qc/delete/(:num)'] = "$folder_qc/analisa_qc/delete/$1";
	// Route for Release Partial
	$route['released_partial'] = "$folder_qc/released_partial";
	$route['released_partial/input'] = "$folder_qc/released_partial/input";
	$route['released_partial/input/(:num)'] = "$folder_qc/released_partial/input/$1";
	$route['released_partial/edit'] = "$folder_qc/released_partial/edit";
	$route['released_partial/edit/(:num)'] = "$folder_qc/released_partial/edit/$1";
	$route['released_partial/view/(:num)'] = "$folder_qc/released_partial/view/$1";
	$route['released_partial/delete/(:num)'] = "$folder_qc/released_partial/delete/$1";
	// Route for Tahanan QC
	$route['tahanan_qc'] = "$folder_qc/tahanan_qc";
	$route['tahanan_qc/proses'] = "$folder_qc/tahanan_qc/proses";
	$route['tahanan_qc/proses/(:num)'] = "$folder_qc/tahanan_qc/proses/$1";
	$route['tahanan_qc/edit'] = "$folder_qc/tahanan_qc/edit";
	$route['tahanan_qc/edit/(:num)'] = "$folder_qc/tahanan_qc/edit/$1";
	$route['tahanan_qc/delete/(:num)'] = "$folder_qc/tahanan_qc/delete/$1";
	// Route for Tahanan RD
	$route['tahanan_rd'] = "$folder_qc/tahanan_rd";
	$route['tahanan_rd/delete/(:num)'] = "$folder_qc/tahanan_rd/delete/$1";
	// Route for OK Pending Monitoring
	$route['ok_pending'] = "$folder_qc/ok_pending";
	$route['ok_pending/proses'] = "$folder_qc/ok_pending/proses";
	$route['ok_pending/proses/(:num)'] = "$folder_qc/ok_pending/proses/$1";
	$route['ok_pending/edit'] = "$folder_qc/ok_pending/edit";
	$route['ok_pending/edit/(:num)'] = "$folder_qc/ok_pending/edit/$1";
	$route['ok_pending/delete/(:num)'] = "$folder_qc/ok_pending/delete/$1";
	// Route for OK Tahanan RD
	$route['ok_tahanan_rd'] = "$folder_qc/ok_tahanan_rd";
	// Route for OK Tahanan QC
	$route['ok_tahanan_qc'] = "$folder_qc/ok_tahanan_qc";
	$route['ok_tahanan_qc/proses'] = "$folder_qc/ok_tahanan_qc/proses";
	$route['ok_tahanan_qc/proses/(:num)'] = "$folder_qc/ok_tahanan_qc/proses/$1";
	$route['ok_tahanan_qc/edit'] = "$folder_qc/ok_tahanan_qc/edit";
	$route['ok_tahanan_qc/edit/(:num)'] = "$folder_qc/ok_tahanan_qc/edit/$1";
	$route['ok_tahanan_qc/delete/(:num)'] = "$folder_qc/ok_tahanan_qc/delete/$1";
	// Route for Reject Release
	$route['reject_release'] = "$folder_qc/reject_release";
	$route['reject_release/input'] = "$folder_qc/reject_release/input";
	$route['reject_release/input/(:num)'] = "$folder_qc/reject_release/input/$1";
	$route['reject_release/edit_spb'] = "$folder_qc/reject_release/edit_spb";
	$route['reject_release/edit_spb/(:num)'] = "$folder_qc/reject_release/edit_spb/$1";
	$route['reject_release/edit'] = "$folder_qc/reject_release/edit";
	$route['reject_release/edit/(:num)'] = "$folder_qc/reject_release/edit/$1";
	$route['reject_release/delete/(:num)'] = "$folder_qc/reject_release/delete/$1";
	$route['reject_release/view/(:num)'] = "$folder_qc/reject_release/view/$1";
	// Route for Reject Monitoring
	$route['reject_monitoring'] = "$folder_qc/reject_monitoring";
	$route['reject_monitoring/input'] = "$folder_qc/reject_monitoring/input";
	$route['reject_monitoring/input/(:num)'] = "$folder_qc/reject_monitoring/input/$1";
	$route['reject_monitoring/edit_spb'] = "$folder_qc/reject_monitoring/edit_spb";
	$route['reject_monitoring/edit_spb/(:num)'] = "$folder_qc/reject_monitoring/edit_spb/$1";
	$route['reject_monitoring/edit'] = "$folder_qc/reject_monitoring/edit";
	$route['reject_monitoring/edit/(:num)'] = "$folder_qc/reject_monitoring/edit/$1";
	$route['reject_monitoring/delete/(:num)'] = "$folder_qc/reject_monitoring/delete/$1";
	$route['reject_monitoring/view/(:num)'] = "$folder_qc/reject_monitoring/view/$1";
	// Route for OK Closed
	$route['ok_closed'] = "$folder_qc/ok_closed";
	$route['ok_closed/edit'] = "$folder_qc/ok_closed/edit";
	$route['ok_closed/edit/(:num)'] = "$folder_qc/ok_closed/edit/$1";
	$route['ok_closed/delete/(:num)'] = "$folder_qc/ok_closed/delete/$1";
	// Route for OK Bersyarat
	$route['ok_bersyarat'] = "$folder_qc/ok_bersyarat";
	$route['ok_bersyarat/edit'] = "$folder_qc/ok_bersyarat/edit";
	$route['ok_bersyarat/edit/(:num)'] = "$folder_qc/ok_bersyarat/edit/$1";
	$route['ok_bersyarat/delete/(:num)'] = "$folder_qc/ok_bersyarat/delete/$1";