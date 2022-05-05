<?php
    class Player {

        private $name;          //Name
        private $id;            //Id
        private $tokenSymbol;   //Tokencharacter 
        private $onTurn = false;        //Is the Player on Turn

        /**
         * Construct the Player object
         * @param string $name
         * @return void
         */
        public function __construct($name){
            $this->name = $name;
        }

        /**
         * Get the $tokenSymbol
         * @return string
         */
        public function getTokenSymbol() {
            return $this->tokenSymbol;
        }

        /**
         * Set the tokencharacter
         * @param string $tokenSymbol 
         * @return void
         */
        public function setTokenSymbol($tokenSymbol): void {
            $this->tokenSymbol = $tokenSymbol;
        }

        /**
         * Get the $name
         * @return string
         */
        public function getName() {
            return $this->name;
        }

        /**
         * Get the $id
         * @return int
         */
        public function getId() {
            return $this->id;
        }

        /**
         * Get $isOnTurn
         * @return boolean
         */
        public function isOnTurn() {
            return $this->onTurn;
        }

        /**
         * Set $onTurn
         * @param boolean $onTurn
         * @return void
         */
        public function setOnTurn($onTurn) {
            $this->onTurn = $onTurn;
        }


    }

?>