
<?php
require '../class/DadosDb.class.php';
require '../class/Conexao.class.php';
require '../inc/funcao.inc.php';

$set_url = setUrl($_SERVER['HTTP_HOST']);
?>
<link rel="stylesheet" type="text/css" href="<?php echo $set_url['url'] ?>css-screm/css-galeria.css" />
<?php
if (isset($_GET['pagina']) && $_GET['pagina'] != 0) {
     $dados_busca = new DadosDb('galeria_titulo', array('categoria_titulo' => $_GET['pagina']));
     $dados_lista = $dados_busca->selectWhere('AND', 'id_titulo DESC');

     if ($dados_lista) {
          ?>

          <ul id="galeria" >
               <?php
               for ($i = 0; $i < count($dados_lista); $i++) {
                    $cat_busca = new DadosDb('galeria_categoria', array('id_categoria' => $dados_lista[$i]->categoria_titulo));
                    $cat_lista = $cat_busca->selectWhere('AND', 'id_categoria');
                    ?>
                    <li style="background-image: url('<?php echo $set_url['url']; ?>imagens/galeria/img_titulo/<?php echo $dados_lista[$i]->imagem ?>');">
                         <div id="div-camada-geral2">                              
                              <p id="titulo-galeria"><?php echo $dados_lista[$i]->nome_titulo ?></p>
                              <p id="categoria-galeria"><?php echo $cat_lista[0]->nome_categoria ?></p>
                              <a id="link-veja-mais" href="<?php echo $set_url['url']; ?>galeria-view/<?php echo $dados_lista[$i]->url_titulo ?>">Veja Mais</a>
                         </div>
                    </li>
                    <?php
               }
               ?>
          </ul>

          <?php
     }
} else {
     $dados_busca = new DadosDb('galeria_titulo', NULL);
     $dados_lista = $dados_busca->selectAll('id_titulo DESC');

     if ($dados_lista) {
          ?>

          <ul id="galeria" >
               <?php
               for ($i = 0; $i < count($dados_lista); $i++) {
                    $cat_busca = new DadosDb('galeria_categoria', array('id_categoria' => $dados_lista[$i]->categoria_titulo));
                    $cat_lista = $cat_busca->selectWhere('AND', 'id_categoria');
                    ?>
                    <li style="background-image: url('<?php echo $set_url['url']; ?>imagens/galeria/img_titulo/<?php echo $dados_lista[$i]->imagem ?>');">
                         <div id="div-camada-geral2">                              
                              <p id="titulo-galeria"><?php echo $dados_lista[$i]->nome_titulo ?></p>
                              <p id="categoria-galeria"><?php echo $cat_lista[0]->nome_categoria ?></p>
                              <a id="link-veja-mais" href="<?php echo $set_url['url']; ?>galeria-view/<?php echo $dados_lista[$i]->url_titulo ?>">Veja Mais</a>
                         </div>
                    </li>
                    <?php
               }
               ?>
          </ul>

          <?php
     }
}
?>

