<?php ?>
<!DOCTYPE html>
<html>
     <head>
          <meta charset="UTF-8" />
          <meta name="viewport" content="width=device-width, initial-scale=1">

          <link rel="shortcut icon" type="image/x-icon" href="<?php echo $set_url['url'] ?>imagens/favicon/326558381db18ebcb6f76c573eeed741c42f.ico" />
          <!--REQUIRE CSS-->          
          <link rel="stylesheet" type="text/css" href="<?php echo $set_url['url'] ?>css-mobile/css-contato.css" />


          <link rel="stylesheet" type="text/css" href="<?php echo $set_url['url'] ?>css-screm/css-contato.css" />
          <link rel="stylesheet" type="text/css" href="<?php echo $set_url['url'] ?>css-screm/fontes.css" />
          <link rel="stylesheet" type="text/css" href="<?php echo $set_url['url'] ?>css-screm/jquery.maximage.css" />
          <link rel="stylesheet" type="text/css" href="<?php echo $set_url['url'] ?>css-screm/jquery.screen.css" />

          <link rel="stylesheet" type="text/css" href="<?php echo $set_url['url'] ?>css-mobile/menuResponsivo_1.css" />

          <!--FIM REQUIRE CSS-->
          <!--REQUIRE SCRIPT-->
          <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
          <script type="text/javascript" src="<?php echo $set_url['url'] ?>js/jquery.cycle.all.js"></script>
          <script type="text/javascript" src="<?php echo $set_url['url'] ?>js/jquery.maximage.js"></script>
          <script type="text/javascript" src="<?php echo $set_url['url'] ?>js/jquery.mask.js"></script>
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


                    $('.fone').mask('(00) 0 0000-0000');


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



          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
               if (isset($_POST['enviar']) && !empty($_POST['nome_email'])) {
                    unset($_POST['enviar']);
                    $_POST['data_email'] = date('Y-m-d');
                    $_POST['nome_email'] = formValidaImputString($_POST['nome_email']);
                    $_POST['de_email'] = formValidaImputString($_POST['de_email']);
                    $_POST['telefone_email'] = formValidaImputString(remove_simbolos($_POST['telefone_email']));
                    $_POST['cidade_email'] = formValidaImputString($_POST['cidade_email']);
                    $_POST['localEvento_email'] = formValidaImputString($_POST['localEvento_email']);
                    $_POST['mensagem_email'] = formValidaImputString($_POST['mensagem_email']);

                    var_dump($_POST);
                    
                    
                    $cadastra = new DadosDb('emails', $_POST);
                    $cadastra->insertDados();
                    
                    if($cadastra){
                         $msg = "<div id='sucesso'>Sua mensagem foi enviada com sucesso</div>";
                    }
                    
                    
               } else {
                    $msg = "<div id='erro'>Todos os campos estão vazios, Preencha o formulário corretamente!</div>";
               }
          }
          ?>

          <section id="formulario">
               <?php
               if (isset($msg)) {
                    echo $msg;
               }
               ?>
               <form action="" method="POST">
                    <table id="tbl-form" class="scream">
                         <tr>
                              <td colspan="2">
                                   <p>* Nome:</p>
                                   <input id="input-one" type="text" name="nome_email" autofocus="" required="" />
                              </td>
                         </tr>
                         <tr>
                              <td colspan="2">
                                   <p>* E-mail:</p>
                                   <input id="input-email" type="email" name="de_email" required=""  />
                              </td>
                         </tr>
                         <tr>
                              <td>
                                   <p>* Telefone:</p>
                                   <input id="input-one" type="tel" name="telefone_email" class="fone" required="" /> 
                              </td>
                              <td>
                                   <p>Cidade:</p>
                                   <input id="input-one" type="text" name="cidade_email" /> 
                              </td>
                         </tr>
                         <tr>
                              <td>
                                   <p>Local do Evento:</p>
                                   <input id="input-one" type="text" name="localEvento_email" /> 
                              </td>
                              <td>
                                   <p>Data do Evento:</p>
                                   <input id="input-one" type="date" name="dataEvento_email" /> 
                              </td>
                         </tr>
                         <tr>
                              <td colspan="2">
                                   <p>* Mensagem:</p>
                                   <textarea id="txtarea" name="mensagem_email" required="" ></textarea>
                              </td>
                         </tr>
                         <tr>
                              <td colspan="2">
                                   <input id="input-btn" type="submit" name="enviar" value="Enviar Mensagem" />
                              </td>
                         </tr>
                    </table>

                    <table id="tbl-form" class="mobile">
                         <tr>
                              <td>
                                   <p>* Nome:</p>
                                   <input id="input-one" type="text" name="nome_email" autofocus="" required="" />
                              </td>
                         </tr>
                         <tr>
                              <td>
                                   <p>* E-mail:</p>
                                   <input id="input-email" type="email" name="de_email" required=""  />
                              </td>
                         </tr>
                         <tr>
                              <td>
                                   <p>* Telefone:</p>
                                   <input id="input-one" type="tel" name="telefone_email" class="fone" required="" /> 
                              </td>
                         </tr>
                         <tr>
                              <td>
                                   <p>Cidade:</p>
                                   <input id="input-one" type="text" name="cidade_email" /> 
                              </td>
                         </tr>
                         <tr>
                              <td>
                                   <p>Local do Evento:</p>
                                   <input id="input-one" type="text" name="localEvento_email" /> 
                              </td>
                         </tr>
                         <tr>
                              <td>
                                   <p>Data do Evento:</p>
                                   <input id="input-one" type="date" name="dataEvento_email" /> 
                              </td>
                         </tr>
                         <tr>
                              <td colspan="2">
                                   <p>* Mensagem:</p>
                                   <textarea id="txtarea" name="mensagem_email" required="" ></textarea>
                              </td>
                         </tr>
                         <tr>
                              <td colspan="2">
                                   <input id="input-btn" type="submit" name="enviarr" value="Enviar Mensagem" />
                              </td>
                         </tr>
                    </table>
               </form>
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
