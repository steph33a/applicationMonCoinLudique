


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link rel="stylesheet" href="styles.css">
     <script src="form_validations.js" defer></script>
</head>
<body>
<main>

    <div id="divBody">
        <h1>Mes scores</h1>
        <table>
            <thead>
                <tr>
                    <th>jeu</th>
                    <th>score</th>
                    <th>date</th>
                </tr>
            </thead>
            <tbody>
                <tr> <?php
                 
                    foreach ($tableauDonneesScores as $score) {
                       ?>
                        <td><?=$score["game"]?></td>
                        <td><?=$score["score"]?></td>
                        <td><?=$score["date"]?></td>
                        </tr>
                        <?php
                    } ?>
                       
                
                
            </tbody>
        </table>


        
    </div>
    <a class="button" href="profil.php">voir mes resultats</a>
</main>
</body>
</html>
