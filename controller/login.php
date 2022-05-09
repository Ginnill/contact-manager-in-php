<?php
require 'db.php';

$login = $_POST['login'] ?? null;
$email = $_POST['email'] ?? null;
$password = $_POST['pwd'] ?? null;



if (isset($login)) :
    if (empty($email) || empty($password)) :
        $message = "<label>Por favor, preencha todos os campos</label>";

    else :

        // Query MySQL
        $query = "SELECT `email`, `password` FROM users WHERE `email` = :email AND `password` = :pass";
        // Running the query
        $statement = $conn->prepare($query);

        $statement->execute([':email' => $email, ':pass' => $password]);

        $count = $statement->rowCount();

        if ($count > 0) :
            $_SESSION['email'] = $email;
            header("location:/teste-fortunato/dashboard");

        else :
            $message = "O email ou a senha estão incorretas!";
        endif;

    endif;
endif;
