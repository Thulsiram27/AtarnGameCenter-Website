<?php

include('mvc/dbView.php');

session_start();

if (empty($_SESSION['id'])) header('location: index.php?invalid-session');
else $id = $_SESSION['id'];

$limit = 3;
$total = 0;

$db = new dbView();

if (isset($_GET['delcart'])) {
    $db->DeleteFromCart($_GET['delcart']);
    header("location: cart.php?deletecart=success");
}

$cartgames = $db->getAllCartGames();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style/cart.css">
    <script src="https://kit.fontawesome.com/9b997b2ecb.js" crossorigin="anonymous"></script>
    <title>Atarn Store | Your Cart</title>
</head>

<body>
    <nav>
        <h1><?php echo $_SESSION['id'] ?>, How are you?</h1>
        <ul>
            <a class="btn" href="dashboard.php">
                <i class="fas fa-gamepad"></i>
                <p>Dashboard</p>
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
            <div class="title-section">
                <h1>YOUR CART</h1>
            </div>
            <div class="upper-section">
                <?php foreach ($cartgames as $game) {
                    $total += $game['cart_total_price'] ?>
                    <div class="card-game">
                        <form class="card-desc" action="cart.php?delcart=<?php echo $game['cart_id'] ?>" method="POST">
                            <div class="card-title">
                                <h2><?php echo $game['cart_games_title'] ?></h2>
                                <a><button type="submit" class="fas fa-times"></button></a>
                            </div>
                            <div class="card-action">
                                <div class="card-amount">
                                    <p>QUANTITY: <span><?php echo $game['cart_quantity'] ?></span></p>
                                    <p>PRICE: <span>RM<?php echo $game['cart_price'] ?></span></p>
                                </div>
                                <div class="card-total">
                                    <p>TOTAL</p>
                                    <p><span>RM<?php echo $game['cart_total_price'] ?></span></p>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php } ?>
            </div>
            <div class="lower-section">
                <h2>PAYMENT</h2>
                <form class="checkout" action="checkout.php" method="POST">
                    <p>TOTAL AMOUNT: </p>
                    <p><span>RM<?php echo $total ?></span></p>
                    <button type="submit">Checkout</button>
                </form>
            </div>
        </section>
    </main>

</body>

</html>