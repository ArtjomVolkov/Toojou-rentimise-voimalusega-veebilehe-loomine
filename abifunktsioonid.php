<?php
global $yhendus;
include("connect.php");
function kustutaUsers($users_id)
{
    global $yhendus;
    $kask = $yhendus->prepare("DELETE FROM users WHERE id=?");
    $kask->bind_param("i", $users_id);
    $kask->execute();
}

function muudaUsers($nimi, $perenimi,$email,$telefon,$dates,$haridus,$category, $users_id)
{
    global $yhendus;
    $kask = $yhendus->prepare("UPDATE users SET nimi=?, perekonnanimi=?, email=?, telefon=?, dates=?, haridus=?, category=? WHERE id=?");
    $kask->bind_param("sssissii", $nimi, $perenimi, $email, $telefon, $dates,$haridus,$category, $users_id);
    $kask->execute();
    $kask->close();
}

function kustutaRabotodatel($rabotodatel_id)
{
    global $yhendus;
    $kask = $yhendus->prepare("DELETE FROM rabotodatel WHERE id=?");
    $kask->bind_param("i", $rabotodatel_id);
    $kask->execute();
    $kask->close();
}

function muudaRabotodatel($nimi,$email,$telefon,$rabotniki,$rabotniki2,$address,$firmicode,$info, $rabotodatel_id)
{
    global $yhendus;
    $kask = $yhendus->prepare("UPDATE rabotodatel SET nimi2=?, email2=?, telefon2=?, rabotniki=?, rabotniki2=?, address=?, firmi_code=?, info2=? WHERE id=?");
    $kask->bind_param("ssisisisi", $nimi,$email,$telefon,$rabotniki,$rabotniki2,$address,$firmicode,$info, $rabotodatel_id);
    $kask->execute();
    $kask->close();
}

function Accept($user_id, $accept)
{
    global $yhendus;
    $kask = $yhendus->prepare("UPDATE users SET accept = ? WHERE id = ?");
    $kask->bind_param("ii", $accept, $user_id);
    $kask->execute();
    $kask->close();
}

function Mustnime($user_id, $mustnime)
{
    global $yhendus;
    $kask = $yhendus->prepare("UPDATE users SET mustnime = ? WHERE id = ?");
    $kask->bind_param("ii", $mustnime, $user_id);
    $kask->execute();
    $kask->close();
}
?>