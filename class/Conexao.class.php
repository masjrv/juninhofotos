<?php

/**
 * Classe de conexão ao banco de dados usando PDO no padrão Singleton.
 * Modo de Usar:
 * $db = Database::conexao();
 * E agora use as funções do PDO (prepare, query, exec) em cima da variável $db.
 */
class Conexao {
     
    # Variável que guarda a conexão PDO.
    protected static $db;

    # Private construct - garante que a classe só possa ser instanciada internamente.
    private function __construct() {

        $db_driver = "mysql";
        # Informações sobre o sistema:
        $sistema_titulo = "juninhofotos.com.br";
        $sistema_email = "contato@juninhofotos.com.br";
        try {

            if ($_SERVER['SERVER_NAME'] == 'juninhofotos.pc') {
                $db_host = "localhost";
                $db_nome = "juninhofotos_banco";
                $db_usuario = "root";
                $db_senha = "";
            } else if ($_SERVER['SERVER_NAME'] == '192.168.1.6') {
                $db_host = "localhost";
                $db_nome = "juninhofotos_banco";
                $db_usuario = "root";
                $db_senha = "";
            } else {
                 
            }

            # Atribui o objeto PDO à variável $db.
            self::$db = new PDO("$db_driver:host=$db_host; dbname=$db_nome", $db_usuario, $db_senha);
            # Garante que o PDO lance exceções durante erros.
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            # Garante que os dados sejam armazenados com codificação UFT-8.
            self::$db->exec('SET NAMES utf8');
        } catch (PDOException $e) {
            # Envia um e-mail para o e-mail oficial do sistema, em caso de erro de conexão.
            mail($sistema_email, "PDOException em $sistema_titulo", $e->getMessage());
            # Então não carrega nada mais da página.
            die("Connection Error: " . $e->getMessage());
        }
    }

    # Método estático - acessível sem instanciação.

    public static function conexao() {
        # Garante uma única instância. Se não existe uma conexão, criamos uma nova.
        if (!self::$db) {
            new Conexao();
        }
        # Retorna a conexão.
        return self::$db;
    }

}
