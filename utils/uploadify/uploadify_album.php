<?php

include_once '../../classes/Conexao.php';
include_once '../../utils/url.php';

$targetFolder = 'upload'; // Relative to the root

$verifyToken = md5('unique_salt' . $_POST['timestamp']);

if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
    $tempFile = $_FILES['Filedata']['tmp_name'];
    $targetPath = $targetFolder;
    $targetFile = $_FILES['Filedata']['name'];
    $ext = end(explode('.', $targetFile));
    $foto_nome_galeria = md5(uniqid()) . "." . $ext;
    $foto_id_galeria = $_GET['id'];


    // Validate the file type
    $fileTypes = array('jpg', 'jpeg', 'gif', 'png', 'JPG'); // File extensions
    $fileParts = pathinfo($_FILES['Filedata']['name']);

    if (in_array($fileParts['extension'], $fileTypes)) {

        require_once '../../classes/InsertDb.php';

        $dados_imagem = array(
            'id_album' => $foto_id_galeria,
            'lamina_album' => $foto_nome_galeria
        );


        $cadastra = new InsertDb($dados_imagem, 'cliente_lamina', Database::conexao());
        $execute = $cadastra->insertDados();


//        if ($cadastra) {
//            require_once "../../utils/wideimage/WideImage.php";
//            $image = WideImage::load($tempFile);
//            $resized_G = $image->resize(1000);
//            $resized_P = $image->resize(200);
//            $resized_G->saveToFile("../../imagens/galeria/vis_grande/" . $foto_nome_galeria);
//            $resized_P->saveToFile("../../imagens/galeria/vis_peguena/" . $foto_nome_galeria);
//        }

    } else {
        echo 'Invalid file type.';
    }
}
?>