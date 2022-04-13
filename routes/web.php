<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});



$router->get('/elemento', 'ElementoController@get'); 
$router->post('/elemento', 'ElementoController@Store');

$router->get('/elemento-fase/{id_proyecto}/{id_fase}', 'ElementoController@GetElemento');

$router->get('/metodologia', 'MetodologiaController@get'); 
$router->get('/metodologia-view/{id}', 'MetodologiaController@view'); 

$router->post('/metodologia', 'MetodologiaController@Store');

$router->post('/fase', 'FaseController@Store');
$router->get('/fases/{id_metodologia}', 'FaseController@SearchFases'); 
$router->get('/fases-proyecto/{id_proyecto}', 'FaseController@getFasesProyecto'); 


$router->get('/search-elemento/{search}', 'ElementoController@SearchElemento');

$router->post('/plantilla', 'PlantillaElementoController@Store');


$router->post('/proyecto', 'ProyectoController@Store');
$router->get('/proyecto-user/{id_usuario}', 'ProyectoController@ListarProyectoUser');
$router->get('/proyecto-view/{id_proyecto}', 'ProyectoController@View');
$router->get('/proyecto-menber/{id_usuario}', 'ProyectoController@ListarProyectoMiembro');

$router->get('/proyecto-jefe/{id_proyecto}', 'ProyectoController@JefeProyectoView');



$router->post('/cronogramaelementos', 'CronogramaElementoController@Store');



$router->get('/usuario', 'UsuarioController@get');
$router->post('/usuario', 'UsuarioController@store');
$router->get('/usuario-all', 'UsuarioController@getAll');
$router->post('/authenticate', 'UsuarioController@Login');

$router->get('/rols', 'RolController@get');
$router->post('/rols', 'RolController@Store');

$router->get('/tipo-usuario', 'TipoUsuarioController@get');


$router->post('/miembro', 'MiembroProyectoController@Store');
$router->get('/miembros/{id_proyecto}', 'MiembroProyectoController@getMember');

$router->post('/version', 'VersionController@Store');
$router->get('/version/{id_cronograma_elemento}', 'VersionController@get');

$router->post('/tarea', 'TareaController@Store');
$router->get('/tarea-version/{id_version}', 'TareaController@get');
$router->get('/tarea-menber/{id_miembro_proyecto}', 'TareaController@GetTareasMenber');
$router->put('/tarea-menber', 'TareaController@Update');
$router->get('/tarea-view/{id_tarea}', 'TareaController@view');

$router->post('/solicitud', 'SolicitudController@Store');
$router->put('/solicitud', 'SolicitudController@Update');
$router->get('/solicitud-pdf/{id_solicitud}', 'SolicitudController@ExportPDF');
$router->get('/solicitud-jefe/{id_jefe}', 'SolicitudController@SolictudesJefe');








