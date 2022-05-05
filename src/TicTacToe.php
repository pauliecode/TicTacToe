<?php

class TicTacToe {

    private $currentPlayer;     //Active Player (Object)
    private $board;             //Board object
    private $allPlayers;        //All Player objects

    /**
     * Construct the TicTacToe object
     * @param string $playerName
     * @param string $playerName2
     * @param int $boardSize
     * @param string $tokenValue
     * @param string $tokenValue2
     * @return void
     * $playerName2, $tokenValue2, $tokenValue changed on 17.03.2022
     */
    public function __construct($playerName,$playerName2){
        $this->allPlayers[0] = new Player($playerName);
        $this->allPlayers[0]->setTokenSymbol("X");
        $this->allPlayers[0]->setOnTurn(true);
        $this->currentPlayer = $this->allPlayers[0];

        $this->allPlayers[1] = new Player($playerName2);
        $this->allPlayers[1]->setTokenSymbol("O");

        $this->board = new Board(3);
    }

    /**
     * Set the active Player
     * @return void
     */
    public function setCurrentPlayer(){
        foreach ($this->allPlayers as $player) {
            $player->setOnTurn(!$player->isOnTurn());
            if($player->isOnTurn() === true){
                $this->currentPlayer = $player;
            }
        }
    }

    // Function that adds the tokens onto the board and updates it
    public function updateBoard() {

        $board = $this->board->getBoardArray();
        $length = count($board) - 1;
        $token = $this->currentPlayer->getTokenSymbol();

        for($i = 0; $i <= $length; $i++){
            for($j = 0; $j <= $length; $j++){
                if(isset($_GET['cell-'.$i.'-'.$j]) && $board[$i][$j] == "") {
                    if (filter_input(INPUT_GET, 'cell-'.$i.'-'.$j, FILTER_SANITIZE_STRING)) {
                        $board[$i][$j] = $token;
                        $this->board->setBoardArray($board);
                    }

                }
            }
        }
        //var_dump($board);
    }

    /**
     * Check if someone has won
     * @return void
     */
    public function checkWin(){

        $countHorizontal = 0;
        $countVertical = 0;
        $countDiagonalTopBottom = 0;
        $countDiagonalBottomTop = 0;
        $board = $this->board->getBoardArray();
        $length = count($board) - 1; 
        $token = $this->currentPlayer->getTokenSymbol();

        // check horizontal
        for($i = 0; $i <= $length; $i++){
            if ($countHorizontal === 3) {
                break;
            } else {
                $countHorizontal = 0;
            }
            for ($j = 0; $j <= $length; $j++) {
                if ($board[$i][$j] === $token) {
                    $countHorizontal++;
                }
            }
        }

        // check vertical
        for($i = 0; $i <= $length; $i++){
            if ($countVertical === 3) {
                break;
            } else {
                $countVertical = 0;
            }
            for ($j = 0; $j <= $length; $j++) {
                if ($board[$j][$i] === $token) {
                    $countVertical++;
                }
            }
            
        }

        // check diagonal top-left to bottom-right
        for ($i = 0; $i <= $length; $i++) {
            if ($board[$i][$i] === $token) {
                $countDiagonalTopBottom++;
            }
        }

        // check diagonal bottom-left to top-right
        for ($i = 0; $i <= $length; $i++) {
            $j = $length - $i;
            if ($board[$j][$i] === $token) {
                $countDiagonalBottomTop++;
            }
        }


        if ($countHorizontal === 3 or $countVertical === 3 
        or $countDiagonalTopBottom === 3 or $countDiagonalBottomTop === 3)  {
            $this->announceWinner();
        } else {
            $this->setCurrentPlayer();
        }
    }

    /**
     * Announce the Winner name
     * @return void
     */
    public function announceWinner(){
        $name = $this->currentPlayer->getName(); // Get the name of the current active player
        echo '<p id="winnerText">The winner is ' . $name . '!</p>';

    }

    // Function that constructs the board
     public function buildBoard(){
        $token = $this->currentPlayer->getTokenSymbol();
        $board = $this->board->getBoardArray();
        $length = count($board) - 1; 

        $output = "";
        for($i = 0; $i <= $length; $i++){
            $output .= '<tr>';
            for($j = 0; $j <= $length; $j++){
                if ($board[$i][$j] != "") {
                    $output .= '<td><span class="color'.$board[$i][$j].'">'.$board[$i][$j].'</span></td>';
                } else {
                    $output .= '<td><input type="submit" class="reset field" name="cell-'.$i.'-'.$j.'" value="'.$token.'" /></td>';    
                }
            }
            $output .= '</tr>';
        }
       echo $output;
    }

    // Function that resets the board and game
    public function reset() {
        $board = $this->board->getBoardArray();
        $length = count($board) - 1;

        for ($i = 0; $i <= $length; $i++) {
            for ($j = 0; $j <= $length; $j++) {

                $board[$i][$j] = "";
                $this->board->setBoardArray($board);
            }
        }
    }

}

?>