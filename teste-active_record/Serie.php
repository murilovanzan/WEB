<?php
    require_once 'config/conexao.php';
    
    class Serie{
        
        private $id;
        private $episodios;
        private $temporadas;

        public function __construct($episodios,$temporadas){
            $this->episodios = $episodios;
            $this->temporadas = $temporadas;
        }

        public function setEpisodios($episodios){
            $this->episodios = $episodios;
        }

        public function setTemporadas($temporadas){
            $this->temporadas = $temporadas;
        }

        public function getEpisiodios(){
            return $this->episodios;
        }

        public function getTemporadas(){
            return $this->temporadas;
        }

        public function salvar(){
            $db = getConnection();
            $sql = "INSERT INTO serie (episodios, temporadas) VALUES (:e, :t);";
            $stmt = $db->prepare($sql);
            return $stmt->execute([':e' => $this->episodios, ':t' => $this->temporadas]);
        }

        public function atualizar(){
            $db = getConnection();
            $sql = "UPDATE serie SET episodios = :e, temporadas = :t WHERE id = :id;";
            $stmt = $db->prepare($sql);
            return $stmt->execute([':e' => $this->episodios, ':t' => $this->temporadas, ':id' => $this->id]);
        }

        public static function delete($id){
            $db = getConnection();
            $sql = "DELETE FROM serie WHERE id = :id;";
            $stmt = $db->prepare($sql);
            return $stmt->execute([':id' => $id]);
        }

        public static function getTodos(){
            $db = getConnection();
            $sql = "SELECT * FROM serie;";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public static function getById($id){
            $db = getConnection();
            $sql = "SELECT * FROM serie WHERE id = :id;";
            $stmt = $db->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
        }
    }
?>