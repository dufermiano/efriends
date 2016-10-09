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
$route['default_controller'] = 'Plataforma'; //controller padr�o da aplica��o
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//rotas da plataforma

//rotas da dashboard
// ESTRUTURA DAS ROTAS
/*
 $route['apelido da rota'] = 'nome do controller/nome do metodo'
 */

//rotas da dashboard

$route['admin'] = 'Dashboard/index'; //direciona para index.php
$route['inicio_dash'] = 'Dashboard/dashboard'; // direciona para dashboard.php
$route['relatorios'] = 'Dashboard/relatorios'; //direciona para relatorios.php
$route['catalogo_obra'] = 'Ebook/catalogo_obra'; //direciona para catalogo.php
$route['cadastro_obra'] = 'Ebook'; //direciona para obra-cadastro.php
$route['perfil'] = 'Admin/perfil'; //direciona para perfil.php
$route['gerencia_ebook'] = 'Ebook/gerencia_ebook'; //direciona para gerencia-ebook.php
$route['clientes'] = 'Cliente/clientes';//direciona para clientes.php
$route['troca_senha'] = 'Dashboard/troca_senha';//direciona para troca_senha_adm.php
$route['logout'] = "Cliente/logout";//chama função de logout
//rotas da plataforma

$route['sobre'] = 'Ebook/sobre_livro';//direciona para sobre.php da plataforma
$route['cadastro_cli'] = 'Plataforma/cadastro_cli';
$route['categorias'] = 'Plataforma/categorias';
$route['todos'] = 'Plataforma/todos';
$route['login'] = 'Plataforma/login';
$route['perfil_cli'] = 'Cliente/perfil'; //direciona para perfil_cli.php, pagina do perfil do cliente