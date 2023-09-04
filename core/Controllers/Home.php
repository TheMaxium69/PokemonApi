<?php
namespace Controllers;



class Home extends Controller
{

    protected $modelName = \Model\Pokemon::class;
    

    /**
     * afficher l'accueil du site
     */

    public function index()
    {


        $exemple = "votre contenue";

        //on fixe le titre de la page
        $titreDeLaPage = "Pokemon Api PE6";

        //on affiche
        \Rendering::render("home/home",
            compact('exemple', 'titreDeLaPage')
        );

    }
}