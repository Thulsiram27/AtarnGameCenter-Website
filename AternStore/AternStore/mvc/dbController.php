<?php

include('dbModel.php');

class dbController extends dbModel
{
    private $safeUsername;
    private $safePassword;
    private $safeConfirmPassword;
    private $safeFullName;
    private $safeBirthDate;
    private $safeNRIC;

    public function Register($username, $fullName, $birthDate, $nric, $password, $confirmpassword)
    {
        $this->safeUsername = htmlspecialchars($username);
        $this->safePassword = htmlspecialchars($password);
        $this->safeConfirmPassword = htmlspecialchars($confirmpassword);
        $this->safeFullName = htmlspecialchars($fullName);
        $this->safeBirthDate = htmlspecialchars($birthDate);
        $this->safeNRIC = htmlspecialchars($nric);

        if ($this->safePassword == $this->safeConfirmPassword && !$this->isDuplicateUser($this->safeUsername)) {
            $this->safePassword = password_hash($this->safePassword, PASSWORD_DEFAULT);
            if ($this->createUser($this->safeUsername, $this->safeFullName, $this->safeBirthDate, $this->safeNRIC, $this->safePassword)) return true;
            else return false;
        } else {
            $_SESSION['error'] = "Please re-check your password";
            return false;
        }
    }

    public function Login($username, $password)
    {
        $this->safeUsername = htmlspecialchars($username);
        $this->safePassword = htmlspecialchars($password);

        if ($this->Authenticate($this->safeUsername, $this->safePassword)) return true;
        else return false;
    }

    public function AddToCart($games_id)
    {
        if ($this->isDuplicateGamesInCart($games_id)) {
            $games = $this->SelectAllGamesCartWHEREid($games_id);
            $this->EditGamesToCart($games);
        } else {
            $games = $this->SelectAllGamesWHEREid($games_id);
            $this->AddGamesToCart($games);
        }
    }

    public function DeleteFromCart($games_id)
    {
        $this->DeleteGamesCart($games_id);
    }

    public function DeleteAllCart()
    {
        return $this->DeleteAllGamesCart();
    }
}
