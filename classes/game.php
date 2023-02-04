<?php
    class Game {
        // Attributs
        public $id;
        public $nb;
        public $aventure;
        public $mission;
        public $vies;
        public $conteur;
        public $joueurs = array();
        public $objets = array();

        // Constructeur
        function __construct($id, $nb, $aventure, $conteur) {
            $this->id = $id;
            $this->nb = $nb;
            $this->aventure = $aventure;
            $this->conteur = $conteur;
            $this->mission = 0;
            $this->vies = 3;
            $this->joueurs = [];
            $this->objets = [];
        }

        // Accesseurs et Mutateurs
        function set_id($id) {
            $this->id = $id;
        }

        function get_id() {
            return $this->id;
        }

        function set_nb($nb) {
            $this->nb = $nb;
        }

        function get_nb() {
            return $this->nb;
        }

        function set_aventure($aventure) {
            $this->aventure = $aventure;
        }

        function get_aventure() {
            return $this->aventure;
        }

        function set_mission($mission) {
            $this->mission = $mission;
        }

        function get_mission() {
            return $this->mission;
        }

        function set_vies($vies) {
            $this->vies = $vies;
        }

        function get_vies() {
            return $this->vies;
        }

        function set_conteur($conteur) {
            $this->conteur = $conteur;
        }

        function get_conteur() {
            return $this->conteur;
        }

        function set_joueurs($joueurs) {
            $this->joueurs = $joueurs;
        }

        function get_joueurs() {
            return $this->joueurs;
        }

        function set_objets($objets) {
            $this->objets = $objets;
        }

        function get_objets() {
            return $this->objets;
        }

        // Méthodes
        function ajoutJoueur($joueur) {
            if (!in_array($joueur, $this->joueurs)) {
                array_push($this->joueurs, $joueur);
            }   
        }

        function trierJoueurs() {
            sort($this->joueurs);
        }

        function ajoutObjet($obj) {
            if (!in_array($obj, $this->objets)) {
                array_push($this->objets, $obj);
            }   
        }

        function retireObjet($obj) {
            $key = array_keys($this->objets, $obj);
            unset($this->objets[$key]);
        }
    }
?>