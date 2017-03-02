<?php ?>
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
          <link rel="stylesheet" type="text/css" href="<?php echo $set_url['url'] ?>css-screm/jquery.maximage.css" />
          <link rel="stylesheet" type="text/css" href="<?php echo $set_url['url'] ?>css-screm/jquery.screen.css" />

          <link rel="stylesheet" type="text/css" href="<?php echo $set_url['url'] ?>css-mobile/menuResponsivo_1.css" />

          <!--FIM REQUIRE CSS-->
          <!--REQUIRE SCRIPT-->
          <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
          <script type="text/javascript" src="<?php echo $set_url['url'] ?>js/jquery.cycle.all.js"></script>
          <script type="text/javascript" src="<?php echo $set_url['url'] ?>js/jquery.maximage.js"></script>
          <script type="text/javascript" src="<?php echo $set_url['url'] ?>js/js.js"></script>

          <script type="text/javascript" charset="utf-8">
               $(function () {
                    // Trigger maximage
                    jQuery('#maximage').maximage();
               });


               $(document).ready(function () {

                    $("#lista-categoria a").click(function (evt) {
                         evt.preventDefault();

                         var url = $(this).attr('href');

                         $.ajax({
                              type: "POST",
                              url: "pagina/galeria-filtro.php?pagina=" + url,
                              beforeSend: function () {
                                   $("#carregando").show();
                              },
                              success: function (data) {
                                   $("#carregando").hide();
                                   $("section[id=galeria]").html(data);
                              }
                         });

                    });

               });

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


          <section id="lista">
               <?php
               $categoria_busca = new DadosDb('galeria_categoria', NULL);
               $categoria_lista = $categoria_busca->selectAll('nome_categoria ASC');
               $categoria_total = count($categoria_lista);


               if ($categoria_lista) {
                    ?>
                    <ul id="lista-categoria">
                         <li><a id="link-categoria" href="0">Todos</a></li>
                         <?php
                         for ($i = 0; $i < $categoria_total; $i++) {
                              ?>
                              <li><a id="link-categoria" href="<?php echo $categoria_lista[$i]->id_categoria ?>"><?php echo $categoria_lista[$i]->nome_categoria ?></a></li>
                              <?php
                         }
                         ?>
                    </ul>
                    <?php
               }
               ?>


          </section>
          <section id="galeria">
               <span id="carregando"></span>
               <?php
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
