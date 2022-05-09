<?php
require 'db.php';

$register = $_POST['register'] ?? null;
$name = $_POST['name'] ?? null;
$email = $_POST['email'] ?? null;
$password = $_POST['pwd'] ?? null;
$password2 = $_POST['pwd2'] ?? null;

if (isset($register)) :
    if (empty($name) || empty($email) || empty($password) || empty($password2)) :
        $message = "<label>Por favor, preencha todos os campos.</label>";

    elseif ($password !== $password2) :
        $message = "<label>As senhas precisam ser idênticas!</label>";

    else :

        // Query MySQL
        $query = "INSERT INTO users(`name` ,`email`, `password`)  VALUES (? ,?, ?)";
        // Running the query
        $statement = $conn->prepare($query);

        $statement->execute([$name, $email, $password]);

        $count = $statement->rowCount();

        header("location:/teste-fortunato/");

        $message = "O email ou a senha estão incorretas!";

    endif;
endif;
