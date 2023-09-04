<?php

namespace Model;

use PDO;

class Pokemon extends Model
{

    protected $table = "pokemon";

    public $id;
    public $hp;
    public $cp;
    public $name;
    public $picture;
    public $types;
    public $created;
    private $create_by;



    /**
     * trouver un pokemon par son id
     *
     * @return pokemon
     */
    public function findById(int $id, string $className)
    {

        $maRequete = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id =:id");

        $maRequete->execute(['id' => $id]);

        $pokemon = $maRequete->fetchObject($className);

        return $pokemon;

    }

    /**
     * ajout d'un pokemon
     */
    function insertPokemon(array $pokemon) : void
    {

        $maRequeteCreatePokemon = $this->pdo->prepare("INSERT INTO {$this->table} (`hp`, `cp`, `name`, `picture`, `types`, `create_by`) VALUES (:hp, :cp, :name, :picture, :types, :create_by)");

        $maRequeteCreatePokemon->execute([
            'hp' => $pokemon['hp'],
            'cp' => $pokemon['cp'],
            'name' => $pokemon['name'],
            'picture'=> $pokemon['picture'],
            'types' => $pokemon['types'],
            'create_by' => $pokemon['create_by'],
        ]);
    }
}
