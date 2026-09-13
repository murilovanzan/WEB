<?php
    require_once 'config/conexao.php';
    
    class Filme extends Video{
        
        private $diretor;
        private array $elenco;

        public function __construct($nome,$descricao,$diretor,array $elenco = []){
            parent::__construct($nome,$descricao);
            $this->diretor = $diretor;
            $this->elenco = $elenco;
        }

        public function setDiretor($diretor){
            $this->diretor = $diretor;
        }

        public function setElenco($elenco){
            $this->elenco = $elenco;
        }

        public function getDiretor(){
            return $this->diretor;
        }

        public function getElenco(){
            return $this->elenco;
        }

        public function addElenco($ator){
            array_push($this->elenco, $ator);
        }

        public function removeElenco($ator){
            $delete = array_search($ator, $this->elenco, true);
            if($delete !== false){
                unset($this->elenco[$delete]);
                $this->elenco = array_values($this->elenco);
            }
        }

        public function salvar(){
            $db = getConnection();
            $sql = "INSERT INTO filme (nome, descricao, diretor, elenco) VALUES (:n, :de, :di, :e);";
            $stmt = $db->prepare($sql);
            return $stmt->execute([':n' => $this->nome, ':de' => $this->descricao, ':di' => $this->diretor, ':e' => $this->elenco]);
        }

        public function atualizar(){
            $db = getConnection();
            $sql = "UPDATE filme SET nome = :n, descricao = :de, diretor = :di, elenco = :e WHERE id = :id;";
            $stmt = $db->prepare($sql);
            return $stmt->execute([':n' => $this->nome, ':d' => $this->descricao, ':di' => $this->diretor, ':e' => $this->elenco, ':id' => $this->id]);
        }

        public static function delete($id){
            $db = getConnection();
            $sql = "DELETE FROM filme WHERE id = :id;";
            $stmt = $db->prepare($sql);
            return $stmt->execute([':id' => $id]);
        }

        public static function getTodos(){
            $db = getConnection();
            $sql = "SELECT * FROM filme;";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public static function getById($id){
            $db = getConnection();
            $sql = "SELECT * FROM filme WHERE id = :id;";
            $stmt = $db->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
        }
    }
?>