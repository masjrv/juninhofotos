
<!DOCTYPE html>
<html>
     <head>
          <meta charset="UTF-8" />
          <meta name="viewport" content="width=device-width, initial-scale=1">

          <link rel="shortcut icon" type="image/x-icon" href="<?php echo $set_url['url'] ?>imagens/favicon/326558381db18ebcb6f76c573eeed741c42f.ico" />
          <!--REQUIRE CSS-->          
          <link rel="stylesheet" type="text/css" href="<?php echo $set_url['url'] ?>css-mobile/css-galeria.css" />


          <link rel="stylesheet" type="text/css" href="<?php echo $set_url['url'] ?>css-screm/css-galeria.css" />
          <link rel="stylesheet" type="text/css" href="<?php echo $set_url['url'] ?>css-screm/fontes.css" />

          <link rel="stylesheet" type="text/css" href="<?php echo $set_url['url'] ?>css-mobile/menuResponsivo.css" />

          <!--FIM REQUIRE CSS-->
          <!--REQUIRE SCRIPT-->
          <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
          <script type="text/javascript" src="<?php echo $set_url['url'] ?>js/js.js"></script>

          <script type="text/javascript" charset="utf-8">
          </script>

          <!--FIM REQUIRE SCRIPT-->
          <title></title>
     </head>
     <body>


          <?php
          if (file_exists('pagina/include/menu-topo.php'))
               require_once 'include/menu-topo.php';
          else
               echo "<div id='erro'>menu-topo.php requisitado não foi encontrado</div>";
          ?>

          <section id="lista-fotos">
               <?php
               $galeria = new DadosDb('galeria_titulo', array('url_titulo' => $_GET['pagina']));
               $id_galeria = $galeria->selectWhere('AND', 'id_titulo');


               $dados_busca = new DadosDb('galeria_fotos', array('id_titulo' => $id_galeria[0]->id_titulo));
               $dados_lista = $dados_busca->selectWhere('AND', 'id_foto');

               $categoria = new DadosDb('galeria_categoria', array('id_categoria' => $id_galeria[0]->categoria_titulo));
               $categoria_escreve = $categoria->selectWhere('AND', 'id_categoria');

               if ($dados_lista) {

                    $titulo = new DadosDb('galeria_titulo', array('id_titulo' => $dados_lista[0]->id_titulo));
                    $escreve_titulo = $titulo->selectWhere('AND', 'id_titulo');
                    ?>

                    <h1 id="titulo-galeria"><?php echo $categoria_escreve[0]->nome_categoria ?> - <?php echo $id_galeria[0]->nome_titulo ?></h1>

                    <ul id="lista-fotos">
                         <?php
                         for ($i = 0; $i < count($dados_lista); $i++) {
                              ?>
                              <li> <img 
                                        id="img-fotos" 
                                        src="<?php echo $set_url['url'] ?>imagens/galeria/vis_grande/<?php echo $dados_lista[$i]->img_foto ?>" 
                                        alt="<?php echo $id_galeria[0]->nome_titulo ?>" 
                                        title="<?php echo $id_galeria[0]->nome_titulo ?>" /> 
                              </li>
                              <?php
                         }
                         ?>

                    </ul>

                    <?php
               }
               ?>
          </section>

          <section id="comentarios">
               <h1>Deixe aqui seu Comentário</h1>
               <?php
               if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['cadastrar'])) {
                         $ip_usuario = $ip = $_SERVER["REMOTE_ADDR"];
                         unset($_POST['cadastrar']);
                         $_POST['data_comentario'] = date('Y-m-d H:i:s');
                         $_POST['ip_comentario'] = $ip_usuario;
                         $_POST['texto_comentario'] = strip_tags(addslashes($_POST['texto_comentario']));
                         $_POST['galeria_coment'] = $id_galeria[0]->id_titulo;


                         $busca = new DadosDb('galeria_coment', array('ip_comentario' => $ip_usuario, 'galeria_coment' => $id_galeria[0]->id_titulo));
                         $dados = $busca->selectWhere(' AND ', ' id_comentario DESC LIMIT 1');

                         if ($dados) {

                              if (addMinuteData('+2', $dados[0]->data_comentario) < date('Y-m-d H:i:s')) {

                                   echo $dados[0]->data_comentario;
                                   echo "<br />a data e menor Que<br />";
                                   echo addMinuteData('+1', date('Y-m-d H:i:s'));
                                   $cadastro = new DadosDb('galeria_coment', $_POST);
                                   $cadastro->insertDados();

                                   if ($cadastro)
                                        header("Location: ../galeria-view/" . $_GET['pagina'] . "#comentarios");
                              } else {
                                   $msg = "<div id='erro'>Voce já postou um comentário a menos de 2 minuto... <br/>por favor aguarde</div>";
                              }
                         } else {
                              $cadastro = new DadosDb('galeria_coment', $_POST);
                              $cadastro->insertDados();

                              if ($cadastro)
                                   header("Location: ../galeria-view/" . $_GET['pagina'] . "#comentarios");
                         }
                    }
               }
               ?>
               <form id="form-comentario" method="post" action="#comentarios">
                    <input id="input-email" type="email" name="email_comentario" required="" placeholder="Digite aqui seu email" />
                    <textarea id="text-comentario" name="texto_comentario" required="" placeholder="Comentário"></textarea>
                    <input id="input-btn" type="submit" name="cadastrar" value="Enviar Comentário" />
               </form>
          </section>

          <section id="exibi-comentario">
               <?php
               if (isset($msg)) {
                    echo $msg;
               }

               $comentario = new DadosDb('galeria_coment', array('galeria_coment' => $id_galeria[0]->id_titulo));
               $dados_comentario = $comentario->selectWhere(' AND ', 'id_comentario DESC');

               if ($dados_comentario) {
                    ?>
                    <ul id="lista-comentario">

                         <?php
                         for ($i = 0; $i < count($dados_comentario); $i++) {
                              ?>
                              <li>
                                   <p>Comentário de: <?php echo $dados_comentario[$i]->email_comentario ?></p>
                                   <p>Postado em: <?php echo dataHora($dados_comentario[$i]->data_comentario) ?></p>
                                   <p><?php echo nl2br($dados_comentario[$i]->texto_comentario) ?></p>
                              </li>
                              <?php
                         }
                         ?>                         
                    </ul>
                    <?php
               }
               ?>



          </section>

          <section id="footer">
               <footer>
                    <?php
                    if (file_exists('pagina/include/footer.php')):
                         require 'include/footer.php';
                    else:
                         echo "<div id='erro'>footer.php requisitado não foi encontrado</div>";
                    endif;
                    ?>
               </footer>
          </section>


     </body>
</html>
