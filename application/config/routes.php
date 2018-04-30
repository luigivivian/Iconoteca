<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Rotas para Home
$route['home/(:any)']        = 'home/index/$1';             // Sem categoria escolhida
$route['home/(:any)/(:num)'] = 'home/index/$1/$2';   // Com categoria escolhida


// Rotas para Home quando realizado uma busca
$route['buscar']        = 'home/buscarArtefato/';
$route['buscar/(:num)'] = 'home/buscarArtefato/$1';

// Rota para Artefato
$route['artefato/(:num)'] = 'artefato/index/$1';      // Acesso às informações do artefato $1

// Rotas para Usuário
$route['login']               = 'usuario/index';
$route['efetuar_login']       = 'usuario/login';
$route['cadastro']            = 'usuario/cadastro';
$route['recuperar']           = 'usuario/recuperarSenha';
$route['cadastrar']           = 'usuario/efetuar_cadastro';
$route['cadinst']             = 'usuario/castro_inst';
$route['logout']              = 'usuario/logout';
$route['conta']               = 'usuario/conta';
$route['conta/desativar']     = 'usuario/desativar_conta';
$route['conta/alterar/senha'] = 'usuario/alterar_senha';
$route['conta/alterar/email'] = 'usuario/alterar_email';
$route['artefato/adicionar/run'] = 'artefato/realizar_insert';
$route['artefato/editar/run'] = 'artefato/editar_run';
