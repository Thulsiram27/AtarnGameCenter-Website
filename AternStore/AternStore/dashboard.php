<?php

include('mvc/dbView.php');

session_start();

if (empty($_SESSION['id'])) header('location: index.php?invalid-session');
else $id = $_SESSION['id'];

$limit = 3;

$db = new dbView();

if (isset($_GET['addcart'])) {
    $db->AddToCart($_GET['addcart']);
}

$amountOfGames = $db->CountGames();
$pages = ceil($amountOfGames / $limit);
$page = isset($_GET['page']) ? $_GET['page'] : 1;

$start = isset($_GET['page']) ? (($_GET['page'] - 1) * $limit) : 0;
$end = isset($_GET['page']) ? ($_GET['page'] * $limit) : $limit;

$arrayOfGames = $db->getAllGames($start, $end);

/* session_start();
include('connection.php');
$ID = $_SESSION["id"];
if (isset($_POST['GTA'])) {
    $sql = "INSERT INTO beli(id,produk,harga) VALUES ('$ID','GRAND THEFT AUTO V ', 199)";
    $query = mysqli_query($conn, $sql);
}

if (isset($_POST['PUBG'])) {
    $sql = "INSERT INTO beli(id,produk,harga) VALUES ('$ID','Player Unknown Battlegrounds',75)";
    $query = mysqli_query($conn, $sql);
}

if (isset($_POST['DS'])) {
    $sql = "INSERT INTO beli(id,produk,harga) VALUES ('$ID','Deadside',39)";
    $query = mysqli_query($conn, $sql);
}

if (isset($_POST['RL'])) {
    $sql = "INSERT INTO beli(id,produk,harga) VALUES ('$ID','Rocket League','19')";
    $query = mysqli_query($conn, $sql);
} */

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style/dashboard.css">
    <script src="https://kit.fontawesome.com/9b997b2ecb.js" crossorigin="anonymous"></script>
    <title>Atarn Store | Home</title>
</head>

<body>
    <nav>
        <h1><?php echo $_SESSION['id'] ?>, How are you?</h1>
        <ul>
            <a class="btn" href="cart.php">
                <i class="fas fa-shopping-cart"></i>
                <p>Your Cart</p>
            </a>
            <a class="btn" href="about-us.html">
                <i class="fas fa-info"></i>
                <p>About</p>
            </a>
            <a class="btn" href="logout.php">
                <i class="fas fa-sign-out-alt"></i>
                <p>Log Out</p>
            </a>
        </ul>
    </nav>
    <main>
        <section>
            <div class="search-bar">
                <input type="text" name="search" id="search" placeholder="Search Bar" />
                <i class="fas fa-search"></i>
            </div>
            <div class="game-list">
                <?php foreach ($arrayOfGames as $game) { ?>
                    <div class="card-game">
                        <div class="card-image">
                            <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($game['games_image']) . '" />'; ?>
                        </div>
                        <form class="card-desc" action="dashboard.php?page=<?php echo $page ?>&addcart=<?php echo $game['id'] ?>" method="POST">
                            <h2><?php echo $game['games_title'] ?></h2>
                            <p><?php echo $game['games_desc'] ?></p>
                            <div class="card-action">
                                <p name="games_price">PRICE: RM<?php echo $game['price'] ?></p>
                                <button type="submit" name="AddToCart"><i class="fas fa-shopping-cart" style="margin-right: 4px;"></i> Add to Cart</button>
                            </div>
                        </form>
                    </div>
                <?php } ?>
            </div>
            <div class="pagination">
                <a href="dashboard.php?page=<?php echo ($page > 1) ? $page -= 1 : 1  ?>"><button class=" fas fa-chevron-left"></button></a>
                <?php for ($i = 1; $i <= $pages; $i++) { ?>
                    <a href="dashboard.php?page=<?php echo $i ?>"><button><?php echo $i ?></button></a>
                <?php } ?>
                <a href="dashboard.php?page=<?php echo ($page < $pages) ? $page += 1 : 1 ?>"><button class="fas fa-chevron-right"></button></a>
            </div>
        </section>
    </main>

</body>

</html>