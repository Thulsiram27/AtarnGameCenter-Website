<?php

include('config/db.php');

class dbModel extends Database
{
    protected function createUser($username, $fullname, $birthdate, $nric, $password)
    {
        $query = 'INSERT INTO kakitangan(username, fullname, birthdate, nric, password) VALUES(?,?,?,?,?)';
        $pdo = $this->connect()->prepare($query);
        if ($pdo->execute([$username, $fullname, $birthdate, $nric, $password])) return true;
        else return false;
    }

    protected function Authenticate($username, $password)
    {
        $query = 'SELECT * FROM kakitangan WHERE username=?';
        $pdo = $this->connect()->prepare($query);
        $pdo->execute([$username]);
        while ($row = $pdo->fetch()) {
            if (password_verify($password, $row['password'])) {
                session_start();
                $_SESSION['id'] = $row['username'];
                return true;
            }
        }
    }

    protected function isDuplicateUser($username)
    {
        $query = 'SELECT username FROM kakitangan WHERE username=?';
        $pdo = $this->connect()->prepare($query);
        $pdo->execute([$username]);
        if ($pdo->rowCount() > 0) return true;
        else return false;
    }

    protected function isDuplicateGamesInCart($games_id)
    {
        $query = 'SELECT cart_id FROM cart WHERE cart_id=?';
        $pdo = $this->connect()->prepare($query);
        $pdo->execute([$games_id]);
        if ($pdo->rowCount() > 0) return true;
        else return false;
    }

    protected function SelectAllGames($start, $end)
    {
        $query = 'SELECT * FROM games LIMIT ?,?';
        $pdo = $this->connect()->prepare($query);
        $pdo->bindParam(1, $start, PDO::PARAM_INT);
        $pdo->bindParam(2, $end, PDO::PARAM_INT);
        $pdo->execute();
        return $pdo->fetchAll();
    }

    protected function SelectAllGamesWHEREid($id)
    {
        $query = 'SELECT id, games_title, price FROM games WHERE id=?';
        $pdo = $this->connect()->prepare($query);
        $pdo->execute([$id]);
        return $pdo->fetchAll();
    }

    protected function SelectAllGamesCart()
    {
        $query = 'SELECT * FROM cart';
        $pdo = $this->connect()->prepare($query);
        $pdo->execute();
        return $pdo->fetchAll();
    }

    protected function SelectAllGamesCartWHEREid($id)
    {
        $query = 'SELECT cart_id, cart_quantity, cart_price FROM cart WHERE cart_id=?';
        $pdo = $this->connect()->prepare($query);
        $pdo->execute([$id]);
        return $pdo->fetchAll();
    }

    protected function GetAmountofGames()
    {
        $query = 'SELECT * FROM games';
        $pdo = $this->connect()->prepare($query);
        $pdo->execute();
        return $pdo->rowCount();
    }

    protected function AddGamesToCart($games)
    {
        $query = 'INSERT INTO cart(cart_id, cart_games_title, cart_price, cart_quantity, cart_total_price) VALUES(?,?,?,?,?)';
        $pdo = $this->connect()->prepare($query);
        $pdo->execute([$games[0]['id'], $games[0]['games_title'], $games[0]['price'], 1, $games[0]['price']]);
    }

    protected function EditGamesToCart($games)
    {
        $query = 'UPDATE cart set cart_quantity=?, cart_total_price=? WHERE cart_id=?';
        $pdo = $this->connect()->prepare($query);
        $quantity = ((int)($games[0]['cart_quantity'])) + 1;
        $pdo->execute([$quantity, (int)($games[0]['cart_price'] * $quantity), $games[0]['cart_id']]);
    }

    protected function DeleteGamesCart($id)
    {
        $query = 'DELETE FROM cart WHERE cart_id=?';
        $pdo = $this->connect()->prepare($query);
        $pdo->execute([$id]);
    }

    protected function DeleteAllGamesCart()
    {
        $query = 'DELETE FROM cart';
        $pdo = $this->connect()->prepare($query);
        $pdo->execute();
        return true;
    }
}
