<?php

function emailVerification($email)
{
    return preg_match('/^[^\s@]+@[^\s@]+\.[^\s@]+$/', $email) && strlen($email) > 0;
}

function somePasswords($passOne, $passTwo)
{
    return $passOne === $passTwo && strlen($passOne) >= 8 && strlen($passOne) <= 30;
}

function nickName($nick)
{
    return preg_match('/^[a-zA-Z0-9_-]+$/', $nick) && strlen($nick) >= 3 && strlen($nick) <= 20;
}
function setSignUp($id)
{
    $_SESSION['id'] = $id;
}