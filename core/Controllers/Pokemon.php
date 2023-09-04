<?php


namespace Controllers;



class Pokemon extends Controller
{

    protected $modelName = \Model\Pokemon::class;


    /*
     * Recupere tout les pokemon
     *
     * @type : get
     *
     */
    public function getAll()
    {

        $pokemons = $this->model->findAll($this->modelName);


        header('Access-Control-Allow-Origin: *');

        //Json
        echo json_encode($pokemons);

    }

    /*
     * Recupere tout les pokemon
     *
     * @type : get
     * @param : id
     *
     */
    public function getById(){

        $pokemon_id = null;
        $msg = null;

         if(!empty($_GET['id']) && ctype_digit($_GET['id'])){

             $pokemon_id = $_GET['id'];

             if(!$pokemon_id){
                 $msg = ["err" => "Id Invalide"];
                 echo json_encode($msg);
             } else {



                 $pokemon = $this->model->findById($pokemon_id, $this->modelName);

                 header('Access-Control-Allow-Origin: *');

                 //json
                 echo json_encode($pokemon);

             }

         } else {

             $msg = ["err" => "Id Invalide"];
             echo json_encode($msg);

         }
    }

    /*
     *
     *
     * Recupere tout les pokemon
     *
     * @type : poste
     * @param : hp, cp, name, picture, types
     *
     */

    public function createPokemon(){

        $msg = null;

        if(!empty($_GET['userApi'])){

            $create_by = $_GET['userApi'];

            if(!empty($_POST['hp']) && !empty($_POST['cp']) && !empty($_POST['name']) && !empty($_POST['picture']) && !empty($_POST['types'])){

                $pokemonCreate = [
                    "hp" => $_POST['hp'],
                    "cp" => $_POST['cp'],
                    "name" => $_POST['name'],
                    "picture" => $_POST['picture'],
                    "types" => $_POST['types'],
                    "create_by" => $create_by,
                ];

                $this->model->insertPokemon($pokemonCreate);

                $msg = ["true" => "Pokemon Create"];
                echo json_encode($msg);

            } else {


                $msg = ["err" => "Pokemon Erreur",
                    "userApi" => $_GET['userApi']];
                echo json_encode($msg);


            }


        } else {


            $msg = ["err" => "UserApi invalide"];
            echo json_encode($msg);

        }






    }


    /*
    *
    *
    * Recupere tout les pokemon
    *
    * @type : get
    * @param : id
    *
    */

    public function deletePokemon(){

        $msg = null;

        if(!empty($_GET['userApi'])){

            $create_by = $_GET['userApi'];

            if(!empty($_GET['id'])){

                $pokemon_id = $_GET['id'];

                $pokemon = $this->model->deletePok($pokemon_id);


                $msg = ["true" => $pokemon['create_by']];
                echo json_encode($msg);

            } else {


                $msg = ["err" => "Pokemon Erreur",
                    "userApi" => $_GET['userApi']];
                echo json_encode($msg);


            }


        } else {


            $msg = ["err" => "UserApi invalide"];
            echo json_encode($msg);

        }






    }



}
