<?php

class Board {

    private $boardArray;    //Multidimensional Array for the TicTacToe board

    /**
     * Construct the Board object
     * @param int $boardSize
     * @return void
     */
    public function __construct($boardSize){
        for ($i = 0; $i < $boardSize; $i++) {
            for ($j = 0; $j < $boardSize; $j++) {
                $this->boardArray[$i][$j] = "";
            }
        }
    }

    /**
     * Return the $boardArray
     * @return array
     */
    public function getBoardArray(){
        return $this->boardArray;
    }

    /**
     * Set the $boardArray
     * @param array $boardArray
     * @return void
     */
    public function setBoardArray($boardArray){
        $this->boardArray = $boardArray;
    }

}

?>