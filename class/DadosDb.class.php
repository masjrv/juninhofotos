<?php

class DadosDb {

     private $tabela, $dados, $conexao;

     function __construct($tabela, $dados) {
          $this->tabela = $tabela;
          $this->dados = $dados;
          $this->conexao = (object) Conexao::conexao();
     }

     function getTabela() {
          return $this->tabela;
     }

     function getDados() {
          return $this->dados;
     }

     function getConexao() {
          return $this->conexao;
     }

     function selectAll($ordem) {

          $sql = "SELECT * FROM " . $this->getTabela() . " ORDER BY " . $ordem;
          $query = $this->getConexao()->query($sql);
          $dados = $query->fetchAll(PDO::FETCH_OBJ);
          return $dados;
     }

     function selectWhere($cond, $ordem) {

          foreach ($this->getDados() as $key => $val) {
               $cols[] = $key . " = ?";
               $vals[] = $val;
          }

          $sql = "SELECT * FROM " . $this->getTabela() . " WHERE " . implode($cond, $cols) . " ORDER BY " . $ordem;
          $busca = $this->getConexao()->prepare($sql);
          $busca->execute($vals);

          $busca_total = $busca->rowCount();
          $busca_lista = $busca->fetchAll(PDO::FETCH_OBJ);

          if ($busca_total > 0) {
               return $busca_lista;
          } else {
               return false;
          }
     }

     function selectLike($cond, $ordem) {

          foreach ($this->getDados() as $key => $val) {
               $cols[] = $key . " LIKE ? ";
               $vals[] = "%" . $val . "%";
          }

          $sql = "SELECT * FROM " . $this->getTabela() . " WHERE " . implode($cond, $cols) . " ORDER BY " . $ordem;
          $busca = $this->getConexao()->prepare($sql);
          $busca->execute($vals);

          $total = $busca->rowCount();
          $lista = $busca->fetchAll(PDO::FETCH_OBJ);

          if ($total > 0)
               return $lista;
          else
               return false;
     }

     function insertDados() {

          //separamos os indices dos valores
          foreach ($this->getDados() as $key => $val) {
               $cols[] = $key;
               $vals[] = $val;
               $sinal[] = '?';
          }

          $sql = "INSERT INTO " . $this->getTabela() . "(" . implode(',', $cols) . ") VALUES(" . implode(',', $sinal) . ")";
          $insert = $this->getConexao()->prepare($sql);
          $insert->execute($vals);
     }

     function updateDados() {

          //separamos os indices dos valores
          foreach ($this->getDados() as $key => $val) {
               $cols[] = " " . $key . " = ?";
               $vals[] = "$val";
          }

//removemos o ultimo valor que sempre sera na clausa WHERE
          $ultimo_indice = array_pop($cols);

//imprimimos o teste
          $sql = "UPDATE " . $this->getTabela() . " SET " . implode(',', $cols) . " WHERE " . $ultimo_indice;

          $dados = $this->getConexao()->prepare($sql);
          $dados->execute($vals);
     }

     function deleteDados() {

          foreach ($this->getDados() as $key => $val) {
               $cols[] = $key;
               $vals[] = $val;
          }

          $sql = "DELETE FROM " . $this->getTabela() . " WHERE " . $cols[0] . " = ?";
          $delete = $this->getConexao()->prepare($sql);
          $delete->execute($vals);
     }

}
