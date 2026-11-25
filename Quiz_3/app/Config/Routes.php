<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
// Matrículas
$routes->get('/', 'MatriculaController::index');

$routes->post('matricula/guardar',
    'MatriculaController::guardar');

$routes->get('matricula/detalle/(:num)',
    'MatriculaController::detalle/$1');

// CRUD de cursos
$routes->get('cursos',
    'CursoController::index');

$routes->get('cursos/crear',
    'CursoController::crear');

$routes->post('cursos/guardar',
    'CursoController::guardar');

$routes->get('cursos/editar/(:num)',
    'CursoController::editar/$1');

$routes->post('cursos/actualizar/(:num)',
    'CursoController::actualizar/$1');

$routes->post('cursos/eliminar/(:num)',
    'CursoController::eliminar/$1');
