<?php

$metas_busca = new BuscaDb(NULL, 'metas', Database::conexao());
$metas_lista = $metas_busca->selectAll('id');
$metas_total = count($metas_lista);


if ($metas_lista) {
    for ($m = 0; $m < $metas_total; $m++) {
        ?>
        <meta name="<?php echo $metas_lista[$m]->name; ?>" <?php if (!empty($metas_lista[$m]->lang)) {
            echo "lang=\"" . $metas_lista[$m]->lang . "\"";
        } ?> content="<?php echo $metas_lista[$m]->content; ?>"  />
        <?php
    }
}
?>