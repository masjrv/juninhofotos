<?php ?>
<!DOCTYPE html>
<html>
     <head>
          <meta charset="UTF-8" />
          <meta name="viewport" content="width=device-width, initial-scale=1">

          <link rel="shortcut icon" type="image/x-icon" href="<?php echo $set_url['url'] ?>imagens/favicon/326558381db18ebcb6f76c573eeed741c42f.ico" />
          <!--REQUIRE CSS-->          
          <link rel="stylesheet" type="text/css" href="<?php echo $set_url['url'] ?>css-mobile/css-quem-somos.css" />


          <link rel="stylesheet" type="text/css" href="<?php echo $set_url['url'] ?>css-screm/css-quem-somos.css" />
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


          <section id="descricao">
               <div id="div-descricao">
                    <?php
                    $dados = new DadosDb('quem_somos', NULL);
                    $lista = $dados->selectAll('id_quemsomos');

                    foreach ($lista as $descricao) {
                         echo nl2br($descricao->descricao_quemsomos);
                    }
                    ?>
               </div>
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
