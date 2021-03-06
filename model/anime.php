<?php
class Anime{
    private $id;
    private $nome;
    private $descricao;
    
    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;

        return $this;
    }

    public function getNome(){
        return $this->nome;
    }
    public function setNome($nome){
        $this->nome = $nome;

        return $this;
    }

    public function getDescricao(){
        return $this->descricao;
    }
    public function setDescricao($descricao){
        $this->descricao = $descricao;

        return $this;
    }

    public function inserirAnime(PDO $conn){
        $sql = "INSERT INTO anime(nome, descricao) VALUES(?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $this->nome);
        $stmt->bindParam(2, $this->descricao);
        $stmt->execute();
        return $conn->lastInsertId();
    }

    public function gerarLista(PDO $conn){
        #ALTERAR DEPOIS
        $sql = "SELECT anime.id idAnime, anime.nome, anime.descricao, videoanime.id idVideo, videoanime.URL FROM anime INNER JOIN videoanime ON anime.id = videoanime.id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $rowAnimes = $stmt->fetchAll();
        return $rowAnimes;
    }

    public function pegarVideo(PDO $conn){
        $sql = "SELECT anime.id idAnime, anime.nome, anime.descricao, videoanime.URL FROM anime INNER JOIN videoanime ON anime.id = ? AND anime.id = videoanime.id ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $rowUnico = $stmt->fetch(PDO::FETCH_ASSOC);
        return $rowUnico;
    }
}

?>