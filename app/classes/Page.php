<?php

namespace App;

class Page
{
    private \Twig\Environment $twig;
    private $link;
    public $session; 

    function __construct()
    {   
        $this->session = new Session();
        $loader = new \Twig\Loader\FilesystemLoader('../templates');
        $this->twig = new \Twig\Environment($loader, [
            'cache' => '../var/cache/compilation_cache',
            'debug' => true
        ]);
        try{
            $this->link = new \PDO('mysql:host=mysql;dbname=b2-paris', "root", "");
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
            die();
        }
    }

    public function insert(string $table_name, array $data){
        $sql = 'INSERT INTO ' . $table_name . ' (email,password,role) VALUES (:email, :password, :role)';
        $sth = $this->link->prepare($sql, [\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY]);
        $sth->execute($data);
    }


    public function GetUserByEmail(array $data){
        $sql = "SELECT * FROM user WHERE email= :email";
        $sth = $this->link->prepare($sql);
        $sth->execute($data);

        return $sth->fetch(\PDO::FETCH_ASSOC);
    }

    public function GetUserInterventions(array $data){//recup toutes les interventions d'un user
        $sql = "SELECT intervention.IDI, intervention.NOM, intervention.DATE FROM intervention, intervient, user WHERE intervention.IDI=intervient.IDI AND intervient.IDU= :idu";
        $sth = $this->link->prepare($sql);
        $sth->execute($data);

        return $sth->fetchAll(\PDO::FETCH_ASSOC); //on fait un fetchAll pour fetch tout ce qu'il y a dans la requete (si on fait un simple fetch on aura que la première valeur)
    }




    public function render(string $name, array $data) :string
    {
        return $this->twig->render($name, $data);
    }
}

