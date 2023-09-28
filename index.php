<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Fée - Restaurant de mafé</title>
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;700&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <img src="assets/images/log.png" class="logo">
    </header>
    <aside id="profile">
        <div class="head">
            <div class="left">
                Mon profil
            </div>
            <div class="right">
                <i class="fa-solid fa-chevron-left"></i>
            </div>
        </div>
    </aside>
    <aside id="cart">
        <div class="head">
            <p class="title">Panier</p>
        </div>
        <div class="content"></div>
        <div class="bottom">
            <button>Payer !</button>
        </div>
    </aside>


    <div class="container">
        <?php
        for ($i = 1; $i < 19; $i++) {
            echo "
                <div class=\"item\">
                    <img src=\"https://generatorfun.com/code/uploads/Random-Food-image-$i.jpg\" class=\"preview\">
                </div>
                ";
        }
        ?>
    </div>

    <script src="assets/js/profileModule.js"></script>
</body>

</html>