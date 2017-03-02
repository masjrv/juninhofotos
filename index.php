<?php

date_default_timezone_set('America/Sao_Paulo');
require_once 'inc/Config.inc.php';
require_once 'inc/funcao.inc.php';

$set_url = setUrl($_SERVER['HTTP_HOST']);


if (isset($_REQUEST['url'])) {


     $conteudo = $_REQUEST['url'];

     if ($conteudo == '') {
          $conteudo = 'home';
          $id = 'nul';
     }
} else {
     $conteudo = 'home';
     $id = 'nul';
}


if (file_exists('pagina/' . $conteudo . '.php')) {
     require('pagina/' . $conteudo . '.php');
} else {
     require('pagina/404.php');
}
?>
