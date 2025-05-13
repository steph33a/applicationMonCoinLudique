
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="form_validations.js"></script>
    <link rel="stylesheet" href="styles.css">

</head>
<body>
<header>
    <h1></h1>

   
</header>    

<main id="accueil">

    <div id="divMain">

        <div class="section" id="section1">
            <div class="text">
                <p>Quiz</p>
                <p>Teste les connaissances avec notre quiz amusant </p>
            </div>
            <form action="quiz.php" method="GET">
            <button type="submit" name="btnJeuQuiz" action="actionDashboard" class="btnSection">Jouer au quiz</button>
            </form>
       
        </div>
        <div class="section" id="section2">
            <div class="text"></div>
            <form action="mot_Melange.php" method="GET">
            <button type="submit" name="btnJeuMotMelange" action="actionDashboard" class="btnSection">mot mélangé</button>
            </form>
            
        </div>
        <div class="section" id="section3">
            <div class="text"></div>
            <form action="nombre.php" method="GET">
            <button type="submit" name="btnJeuNombreMystere"  action="actionDashboard" class="btnSection">Nombre Mystère</button>
            </form>
            
        </div>
    </div>
    <div>
        <h3>Mes scores</h3>
        <p>Consulte tes scores dans les différents jeux ci-dessous</p>
        
        <form action="scores.php" method="GET">
            <button type="submit" name="btnScores" action="actionDashboard" class="btnSection">voir mes scores </button>
        </form>
    </div>
   
</main>
<footer>
    <form action="logout.php" method="GET">
            <button type="submit" name="btnDeconnexion" action="actionDashboard" class="btnDeconnexion">Déconnexion</button>
    </form>
</footer>
</body>
</html>
?>
