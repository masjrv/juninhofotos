<?php

if ($_SERVER['SERVER_NAME'] == 'localhost') {
    $url_principal = "http://localhost/juninhofotos/";
    $url_painel = "http://localhost/juninhofotos/painel/";
} else if ($_SERVER['SERVER_NAME'] == '192.168.1.6') {
    $url_principal = "http://192.168.1.6/juninhofotos/";
    $url_painel = "http://192.168.1.6/juninhofotos/painel/";
} else {
    $url_principal = "http://juninhofotos.com.br/";
    $url_painel = "http://juninhofotos.com.br/painel/";
}

function conta_visitas($tabela) {
    #definimos a zona
    date_default_timezone_set('America/Sao_Paulo'); // atualizado em 19/08/2013
    $ip = $_SERVER["REMOTE_ADDR"];
    $data = date('Y-m-d');

    $buscaVisitas = Database::conexao()->prepare("SELECT * FROM " . $tabela . " WHERE ip = :ip AND data = :data");
    $buscaVisitas->bindValue(':ip', $ip);
    $buscaVisitas->bindValue(':data', $data);
    $buscaVisitas->execute();
    $totalVistasGravadas = $buscaVisitas->rowCount();
    if ($totalVistasGravadas == 0) {

        $gravaVisita = Database::conexao()->prepare("INSERT INTO " . $tabela . "(data,ip) VALUES (:data,:ip)");
        $gravaVisita->bindValue(':data', $data);
        $gravaVisita->bindValue(':ip', $ip);
        $gravaVisita->execute();
    }
}

function enviar_mensagem_celular($celular, $nome, $mensagem) {

    function requisicaoApi($params, $endpoint) {
        $url = "http://api.directcallsoft.com/{$endpoint}";
        $data = http_build_query($params);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $return = curl_exec($ch);
        curl_close($ch);
        // Converte os dados de JSON para ARRAY
        $dados = json_decode($return, true);
        return $dados;
    }

// CLIENT_ID que é fornecido pela DirectCall (Seu e-mail)
    $client_id = "contato@juninhofotos.com.br";
// CLIENT_SECRET que é fornecido pela DirectCall (Código recebido por SMS)
    $client_secret = "9472601";
// Faz a requisicao do access_token
    $req = requisicaoApi(array('client_id' => $client_id, 'client_secret' => $client_secret), "request_token");
//Seta uma variavel com o access_token
    $access_token = $req['access_token'];
// Enviadas via POST do nosso contato.html
// Monta a mensagem
    $txt = $mensagem . $nome;
// Array com os parametros para o envio
    $data = array(
        'origem' => "47999724379", // Seu numero que Ã© origem
        'destino' => $celular, // E o numero de destino
        'tipo' => "texto",
        'access_token' => $access_token,
        'texto' => $txt
    );

// realiza o envio
    $req_sms = requisicaoApi($data, "sms/send");

    if ($req_sms) {
        return TRUE;
    }
}



?>