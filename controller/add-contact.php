<?php

require "db.php";

$contact_name = $_POST['add-name'] ?? null;
$contact_email =  $_POST['add-email'] ?? null;
$contact_phone = $_POST['add-phone'] ?? null;
$contact_register = $_POST['add-register'] ?? null;

if (isset($contact_register)) :
    if (empty($contact_name) || empty($contact_email) || empty($contact_phone)) :
        $add_message = "<label>Por favor, preencha todos os campos de texto</label>";

    else :

        // upload file

        if (($_FILES['add-file']['name'] != "")) :
            // Where the file is going to be stored
            $target_dir = "./upload/";
            $file = $_FILES['add-file']['name'];
            $path = pathinfo($file);
            $filename = $path['filename'];
            $ext = $path['extension'];
            $temp_name = $_FILES['add-file']['tmp_name'];
            $path_filename_ext = $target_dir . $filename . "." . $ext;

            // Check if file already exists
            if (file_exists($path_filename_ext)) :
                $file_message = "O arquivo já exsite!";
            else :
                move_uploaded_file($temp_name, $path_filename_ext);
                $file_message = "Arquivo foi enviado com sucesso";
            endif;
        else :
            $path_filename_ext = "";
        endif;

        //  running query

        // validation
        $validation_query = "SELECT * FROM contacts WHERE `name` = ? AND `email` = ?";
        $validation_statement = $conn->prepare($validation_query);
        $validation_statement->execute([$contact_name, $contact_email]);

        $validation_result = $validation_statement->fetch(PDO::FETCH_ASSOC);

        if ($validation_result['name'] == $contact_name && $validation_result['email'] == $contact_email) :
            $add_message = "Este contato já existe!";

        else :
            //Runnning 
            $add_query = "INSERT INTO contacts(`name`, `email`, `phone`, `image`) VALUES (?, ?, ?, ?)";

            $add_statement = $conn->prepare($add_query);

            $add_statement->execute([
                $contact_name,
                $contact_email,
                $contact_phone,
                $path_filename_ext,
            ]);

            $check_contact = "SELECT * FROM contacts WHERE `name` = :checkname";

            $check_statement = $conn->prepare($check_contact);
            $check_statement->execute([":checkname" => $contact_name]);

            $result = $check_statement->fetch(PDO::FETCH_ASSOC);

            if ($result['name'] == $contact_name) :
                $add_message_success = "O Contato foi criado com sucesso!";

                // add contact in grid on dashboard
?>
                <script>
                    let contactBox = document.querySelector(".contact-box");

                    contactBox.insertAdjacentHTML('afterend',
                        `<div class="card border-0 col-md-6 col-lg-4">
                        <div class="border bg-white">

                            <?php if ($result['image'] != "") : ?>
                                <img width="280px" height="280px" src="<?= $result['image'] ?>" class="card-img-top" alt="...">
                            <?php else : ?>
                                <img src="./img/img-avatar.png" class="card-img-top" alt="...">
                            <?php endif; ?>
        
                            <div class="card-body">
                                <h5 class="card-title"><?= $result['name'] ?></h5>
                            </div>
                            <ul class="list-group list-group-flush border-top">
                                <li class="list-group-item">Email: <?= $result['email']  ?></li>
                                <li class="list-group-item">Telefone: <?= $result['phone'] ?></li>
                            </ul>
                            <div class="card-body border-top d-flex flex-wrap justify-content-around">
                                <a href="#" class="card-link">Editar</a>
                                <a href="#" class="card-link text-danger">Excluir</a>
                            </div>
                        </div>
                    </div>`)

                    document.location.reload()
                </script>
<?php


                $header_id = str_replace(" ", "-", $result['name']);
                header("location:/teste-fortunato/dashboard#$header_id");

            endif;
        endif;
    // Validation
    endif;
endif;
