
<?php
$dados_background = new DadosDb('background', null);
$lista_background = $dados_background->selectAll('id_background DESC');
$total_background = count($lista_background);


if ($lista_background) {
     echo "<div id=\"maximage\">";
     for ($i = 0; $i < $total_background; $i++) {
          ?>

          <img src="<?php echo $set_url['url'] ?>imagens/folder/<?php echo $lista_background[$i]->nome_background ?>" />
          <?php
     }//for
     echo "</div>";
}//if($lista_background)
?>
