<?php
    class Game {
        // Attributs
        public $id;
        public $nb;
        public $aventure;
        public $mission;
        public $vies;
        public $conteur;
        public $etape;
        public $joueurs = array();
        public $objets = array();
        public $objV = array();
        public $objR = array();
        public $objG = array();

        // Constructeur
        function __construct($id, $nb, $aventure, $conteur) {
            $this->id = $id;
            $this->nb = $nb;
            $this->aventure = $aventure;
            $this->conteur = $conteur;
            $this->mission = 0;
            $this->vies = 3;
            $this->etape = 0;
            $this->joueurs = [];
            $this->objets = [];
            $this->objV = [];
            $this->objR = [];
            $this->objG = [];
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

        function set_etape($etape) {
            $this->etape = $etape;
        }

        function get_etape() {
            return $this->etape;
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

        function set_objV($objV) {
            $this->objV = $objV;
        }

        function get_objV() {
            return $this->objV;
        }

        function set_objR($objR) {
            $this->objR = $objR;
        }

        function get_objR() {
            return $this->objR;
        }

        function set_objG($objG) {
            $this->objG = $objG;
        }

        function get_objG() {
            return $this->objG;
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

        function nbObjets() {
            return count($this->objets);
        }

        function ajoutObjet() {
            $rnd = random_int(1, 110);
            while (in_array($rnd, $this->objets)) {
                $rnd = random_int(1, 110);
            }
            array_push($this->objets, $rnd); 
        }

        function retireObjet($obj) {
            $key = array_keys($this->objets, $obj);
            unset($this->objets[$key]);
        }

        function ajoutObjV($obj) {
            array_push($this->objV, $obj); 
        }

        function ajoutObjR($obj) {
            array_push($this->objR, $obj); 
        }

        function ajoutObjG($obj) {
            array_push($this->objG, $obj); 
        }
    }
?>