<?php
    require_once 'config/conexao.php';

    class Video {

        private $id;
        private $nome;
        private $descricao;

        public function __construct($nome,$descricao){
            $this->nome = $nome;
            $this->descricao = $descricao;
        }

        public function setNome($nome){
            $this->nome = $nome;
        }

        public function setDescricao($descricao){
            $this->descricao = $descricao;
        }

        public function getNome(){
            return $this->nome;
        }

        public function getDescricao(){
            return $this->descricao;
        }

        public function salvar(){
            $db = getConnection();
            $sql = "INSERT INTO video (nome, descricao) VALUES (:n, :d);";
            $stmt = $db->prepare($sql);
            return $stmt->execute([':n' => $this->nome, ':d' => $this->descricao]);
        }

        public function atualizar(){
            $db = getConnection();
            $sql = "UPDATE video SET nome = :n, descricao = :d WHERE id = :id;";
            $stmt = $db->prepare($sql);
            return $stmt->execute([':n' => $this->nome, ':d' => $this->descricao, ':id' => $this->id]);
        }

        public static function delete($id){
            $db = getConnection();
            $sql = "DELETE FROM video WHERE id = :id;";
            $stmt = $db->prepare($sql);
            return $stmt->execute([':id' => $id]);
        }

        public static function getTodos(){
            $db = getConnection();
            $sql = "SELECT * FROM video;";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public static function getById($id){
            $db = getConnection();
            $sql = "SELECT * FROM video WHERE id = :id;";
            $stmt = $db->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
        }
    }
?>