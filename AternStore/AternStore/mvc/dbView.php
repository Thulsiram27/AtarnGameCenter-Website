<?php

include('dbController.php');

class dbView extends dbController
{

    public function getAllGames($start, $end)
    {
        return $this->SelectAllGames($start, $end);
    }

    public function getAllCartGames()
    {
        return $this->SelectAllGamesCart();
    }

    public function searchGame()
    {
    }

    public function CountGames()
    {
        return $this->GetAmountofGames();
    }
}
