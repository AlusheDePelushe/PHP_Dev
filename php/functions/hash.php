<?php

function generarHash($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

?>
