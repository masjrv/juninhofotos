<?php ?>
<!DOCTYPE html>
<html>
     <head>
          <meta charset="UTF-8" />
          <meta name="viewport" content="width=device-width, initial-scale=1">

          <link rel="shortcut icon" type="image/x-icon" href="<?php echo $set_url['url'] ?>imagens/favicon/326558381db18ebcb6f76c573eeed741c42f.ico" />
          <!--REQUIRE CSS-->          
          <link rel="stylesheet" type="text/css" href="<?php echo $set_url['url'] ?>css-mobile/css-geral.css" />


          <link rel="stylesheet" type="text/css" href="<?php echo $set_url['url'] ?>css-screm/css-geral.css" />
          <link rel="stylesheet" type="text/css" href="<?php echo $set_url['url'] ?>css-screm/fontes.css" />
          <link rel="stylesheet" type="text/css" href="<?php echo $set_url['url'] ?>css-screm/jquery.maximage.css" />
          <link rel="stylesheet" type="text/css" href="<?php echo $set_url['url'] ?>css-screm/jquery.screen.css" />

          <link rel="stylesheet" type="text/css" href="<?php echo $set_url['url'] ?>css-mobile/menuResponsivo.css" />

          <!--FIM REQUIRE CSS-->
          <!--REQUIRE SCRIPT-->
          <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js"></script>
          <script type="text/javascript" src="<?php echo $set_url['url'] ?>js/jquery.cycle.all.js"></script>
          <script type="text/javascript" src="<?php echo $set_url['url'] ?>js/jquery.maximage.js"></script>
          <script type="text/javascript" src="<?php echo $set_url['url'] ?>js/js.js"></script>

          <script type="text/javascript" charset="utf-8">
               $(function () {
                    // Trigger maximage
                    jQuery('#maximage').maximage();
               });



          </script>

          <!--FIM REQUIRE SCRIPT-->
          <title></title>
     </head>
     <body>
          <section id="background">
               <?php
               if (file_exists('pagina/include/background.php'))
                    require 'include/background.php';
               else
                    echo "<div id='erro'>background.php requisitado não foi encontrado</div>";
               ?>



               <?php
               if (file_exists('pagina/include/menu-topo.php'))
                    require_once 'include/menu-topo.php';
               else
                    echo "<div id='erro'>menu-topo.php requisitado não foi encontrado</div>";
               ?>

               <section id="info-home">
                    (47) 9 9117.7451 Vanusa - (47) 9 9972.4379 Junior - contato@juninhofotos.com.br
               </section>

          </section>
          <section id="sessao_two">
               <h1>Fotógrafo de Momentos</h1>
               <p>
                    Eu amo o meu trabalho, e por isso trabalho com amor.<br>
                    Viaje pelo meu site, se apaixone por lugares e pessoas.
               </p>
               <a id="link_mais" href="<?php echo $set_url['url'] ?>quem-somos">Saiba mais</a>

               <?php echo str_repeat('<br>', 4) ?>
               <h1>Trabalhos Recentes</h1>

               <?php
               $galeria_dados = new DadosDb('galeria_titulo', null);
               $galeria_lista = $galeria_dados->selectAll('id_titulo DESC LIMIT 8');
               $galeria_total = count($galeria_lista);

               if ($galeria_lista) {
                    ?>
                    <ul id="lista-trabalhos" >                    
                         <?php
                         for ($i = 0; $i < $galeria_total; $i++) {
                              ?>
                              <li style="background-image: url('<?php echo $set_url['url']; ?>imagens/galeria/img_titulo/<?php echo $galeria_lista[$i]->imagem ?>');">
                                   <div id="div-camada-geral2">                              
                                        <p><?php echo $galeria_lista[$i]->nome_titulo; ?></p>
                                        <p>Festa</p>
                                        <a id="link-veja-mais" href="">Veja Mais</a>
                                   </div>
                              </li>
                              <?php
                         }
                         ?>

                    </ul>
                    <?php
               }
               ?>


               <!--INSTAGRAM-->
               <?php echo str_repeat('<br>', 4) ?>
               <h1>Instagram</h1>

               <div id="div_insragram">
                    <!-- LightWidget WIDGET -->
                    <!-- LightWidget WIDGET --><script src="//lightwidget.com/widgets/lightwidget.js"></script>
                    <iframe src="//lightwidget.com/widgets/cea3dcd255fb522899acab9fdd0569e2.html" 
                            scrolling="no" 
                            allowtransparency="true" 
                            class="lightwidget-widget" 
                            style="width: 100%; border: 0; overflow: hidden;">

                    </iframe>


               </div>

               <footer>
                    <?php
                    if (file_exists('pagina/include/footer.php'))
                         require 'include/footer.php';
                    else
                         echo "<div id='erro'>footer.php requisitado não foi encontrado</div>";
                    ?>
               </footer>
          </section>
     </body>
</html>
