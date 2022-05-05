<?php
session_start();
//error_reporting(0);
//session_destroy();
if(!isset($_SESSION["TicTacToe"])){ 
?>

<?php
}

// Defining the autoload that will automatically load all the files
// that are called inside the autoload.php file
define ('BASEPATH', realpath(dirname(__FILE__)));
require_once (BASEPATH.DIRECTORY_SEPARATOR.'vendor' .DIRECTORY_SEPARATOR.'autoload.php');



// If reset is not null
    if (isset($_GET['reset'])) {
        // Create a PHP value from the stored representation
        $ttt = unserialize($_SESSION["TicTacToe"]);
        // Call the function that resets the board and game
        $ttt->reset();
        // Generates a storable representation of the object instanciated above
        $_SESSION["TicTacToe"] = serialize($ttt);

        //If the session is null
    } elseif(!isset($_SESSION["TicTacToe"])) {
        // Instanciate an object of the TicTacToe class, adding the two parameters to its constructor
        $ttt = new TicTacToe("Player 1", "Player 2");
        // Generates a storable representation of the object instanciated above
        $_SESSION["TicTacToe"] = serialize($ttt);
    } else {
        // Create a PHP value from the stored representation
        $ttt = unserialize($_SESSION["TicTacToe"]);
        // Call the function that updates the board (Adds tokens onto the board)
        $ttt->updateBoard();
        // Call the function that checks if someone has won
        $ttt->checkWin();
        
        // Generates a storable representation of the TicTacToe object
        $_SESSION["TicTacToe"] = serialize($ttt);
    }
        

?>



<!-- HTML/CSS -->
<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tic-Tac-Toe. This is the title. It is displayed in the titlebar of the window in most browsers.</title>
    <meta name="description" content="Tic-Tac-Toe-Game. Here is a short description for the page. This text is displayed e. g. in search engine result listings.">
    <!-- Bootstrap -->
    <link href="./css/bootstrap.css" rel="stylesheet">
    <link href="./css/add.css" rel="stylesheet"> <!-- You could add your own css-definitions in a file - but you have to create it first... -->
    <!-- The following css-definitions are used just for showing you where the components of this page are placed. Feel free to delete the whole style-tag and to remove the classes in the html elements. -->
    <style>
        .bg-colorESFLGruen {
            background-color: #00948e;
        }
        .bg-colorESFLRot {
            background-color: #c81657;
        }
        .bg-colorESFLBlau {
            background-color: #0d80b9;
        }
        .bg-colorESFLGelb {
            background-color: #f6d700;
        }
        .bg-colorESFLGrau {
            background-color: #3d3d3b;
        }
        .bg-colorWhite {
            background-color: white;
        }
        .textWhite {
            color: white;
        }
        .navbar-logo {
            height: 34px;
        }
        .footer-logo {
            height: 8rem;
            border: .5rem solid white;
        }
        
        #winnerText {
        text-align: center;
        font-size: 30px;
        margin-top: 100px;
    }
        table.tic td {
            border: 1px solid #333; /* grey cell borders */
            width: 8rem;
            height: 8rem;
            vertical-align: middle;
            text-align: center;
            font-size: 4rem;
            font-family: Arial;
        }
        table { margin-bottom: 2rem; }
        input.field {
            border: 0;
            background-color: white;
            color: white; /* make the value invisible (white) */
            height: 8rem;
            width: 8rem !important;
            font-family: Arial;
            font-size: 4rem;
            font-weight: normal;
            cursor: pointer;
        }
        input.field:hover {
            border: 0;
            color: #c81657; /* red on hover */
        }
        table.tic input{
            width: 2rem;
        }
        .colorX { color: #e77; } /* X is light red */
        .colorO { color: #77e; } /* O is light blue */
        table.tic { border-collapse: collapse; }
    </style>
    <!--[if lt IE 9]>
      <script src="./js/html5shiv.min.js"></script>
      <script src="./js/respond.min.js"></script>
    <![endif]-->
</head>
<body class="bg-colorESFLGruen">
    <header class="container">
        <p></p>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                <a class="navbar-brand" href="index.php"><img src="img/esfllogo.png" class="navbar-logo" alt="ESFL-Logo"/></a><p class="navbar-text">Tic-Tac-Toe</p>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="index.php">Start new <span class="sr-only">(current)</span></a></li>
                        <li><a href="https://de.wikipedia.org/wiki/Tic-Tac-Toe" target="_blank">Über Tic-Tac-Toe</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </header>
    <section class="container bg-colorWhite">
        <h1 class="bg-colorESFLBlau">Hi, Flensburg developers!</h1>
        <p>Here comes the first game..</p>
        <button data-target="#infotext" class="btn btn-default btn-xs" data-toggle="collapse"><span class="glyphicon glyphicon-menu-up"></span> Infotext minimieren/maximieren.</button>
        <div id="infotext" class="jumbotron col-md-12 collapse in">
            <div class="col-md-3">
                <a title="By Thomas Steiner [GFDL (http://www.gnu.org/copyleft/fdl.html) or CC-BY-SA-3.0 (http://creativecommons.org/licenses/by-sa/3.0/)], via Wikimedia Commons" href="https://commons.wikimedia.org/wiki/File%3ATictactoe1.gif" target="_blank">
                    <img alt="Tictactoe1" src="https://upload.wikimedia.org/wikipedia/commons/3/33/Tictactoe1.gif" class="img-responsive img-rounded"/></a>
            </div>
            <div class="col-md-9">
                <p>Tic-Tac-Toe (auch: Drei gewinnt, Kreis und Kreuz, Dodelschach) ist ein klassisches, einfaches Zweipersonen-Strategiespiel, dessen Geschichte sich bis ins 12. Jahrhundert v. Chr. zurückverfolgen lässt...<br/> <small><a href="https://en.wikipedia.org/wiki/Tic-tac-toe" target="_blank">(bei Wikipedia weiterlesen...)</a></small></p>
                <p class="bg-info">Du spielst das Kreuz und darfst beginnen. Klicke hierzu in das gewünschte Feld auf dem Spielfeld... <br />
            Wenn ein Unentschieden erreicht wird, klicken Sie bitte auf „Play Again"</p>
            </div>
        </div>
        <article id="mainContent">
            <h2>Playing...</h2>
            <div class="row level1">
                <div class="col-md-offset-4 col-md-4">
                    <form method="get" class="">
                        <table class="tic" style="border-collapse: collapse">
                        <?php
                        $ttt->buildBoard();
                        ?>
                        </table>
                    <input id="playAgainBtn" type="submit" name="reset" value="Play Again!" />
<!--                        <p>Computer intelligence:
                            <select name="ai">
                                <option value="1" selected="selected">Hard</option>
                                <option value="2">Easy</option>
                            </select>
                        </p>-->
                    </form>
                </div>
            </div>
        </article>

    </section>
    <footer class="container bg-colorESFLGelb">
        <div class="col-md-6">
            <p>Author: Paula Alemany <br />March 2022 <br /><a class="btn btn-info btn-xs" role="button" href="https://validator.w3.org/#validate_by_input" target="_blank">https://validator.w3.org/#validate_by_input</a></p>
        </div>
        <div class="col-md-6">
            <p class="text-right"><span class="glyphicon glyphicon-copyright-mark"></span> <span class="text-capitalize">by Anwendungsentwicklung IT-21</span><br /><a href="http://www.esfl.de/" target="_blank">Eckener-Schule Flensburg<br /><img src="img/esfllogo-white.png" class="footer-logo img-rounded" alt="ESFL-Logo"/></a></p>
        </div>
    </footer>
    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.js"></script>
    <script src="./js/script.js"></script> 
</body>
</html>




