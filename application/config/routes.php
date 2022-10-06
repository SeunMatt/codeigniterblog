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

//front-end routes
$route['default_controller'] = "indexController";
$route['posts/(:any)'] = "front/postController/view/$1";

//authentication routes
$route['login']['get'] = "auth/loginController/index";
$route['fb-login-callback'] = "auth/loginController/facebookLogin";
$route['login']['post'] = "auth/loginController/login";
$route['register']['get'] = 'auth/registerController/index';
$route['register']['post'] = 'auth/registerController/register';
$route['logout']['post'] = "auth/logoutController/logout";

//admin routes
$route['admin/dashboard']['get'] = "admin/adminController/index";
$route['admin/posts']['get'] = "admin/adminPostsController/index";
$route['admin/posts/add'] = "admin/adminPostsController/add";
$route['admin/posts/add/bulk'] = "admin/adminPostsController/bulk";
$route['admin/posts/json']['get'] = "admin/adminPostsController/getPostsJson";
$route['admin/posts/delete']['post'] = 'admin/adminPostsController/delete';
$route['admin/posts/edit/(:any)']['get'] = "admin/postController/edit";

//logs
$route['admin/logs']['get'] = "admin/logViewerController/index";
$route['api/v1/admin/logs']['get'] = "admin/apiLogViewerController/index";

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
