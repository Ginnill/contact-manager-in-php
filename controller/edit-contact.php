<?php

require "db.php";

$contact_id = $_POST['edit-id'] ?? null;
$contact_name = $_POST['edit-name'] ?? null;
$contact_email =  $_POST['edit-email'] ?? null;
$contact_phone = $_POST['edit-phone'] ?? null;
$contact_register = $_POST['edit-register'] ?? null;



if (isset($contact_register)) :
    if (empty($contact_name) || empty($contact_email) || empty($contact_phone)) :
        $edit_message = "<label>Por favor, preencha todos os campos de texto</label>";

    else :


        // upload file

        if (($_FILES['edit-file']['name'] != "")) :
            // Where the file is going to be stored
            $target_dir = "./upload/";
            $file = $_FILES['edit-file']['name'];
            $path = pathinfo($file);
            $filename = $path['filename'];
            $ext = $path['extension'];
            $temp_name = $_FILES['edit-file']['tmp_name'];
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

        $edit_query = "UPDATE contacts SET `name` = ?, `email` = ?, `phone` = ?, `image` = ? WHERE id = ?";

        $edit_statement = $conn->prepare($edit_query);

        $edit_statement->execute([
            $contact_name,
            $contact_email,
            $contact_phone,
            $path_filename_ext,
            $contact_id,
        ]);

        $edit_check_contact = "SELECT * FROM contacts WHERE `id` = :id";

        $edit_check_statement = $conn->prepare($edit_check_contact);
        $edit_check_statement->execute([":id" => $contact_id]);

        $edit_result = $edit_check_statement->fetch(PDO::FETCH_ASSOC);

        $oba = $edit_result;

        if ($edit_result['name'] == $contact_name) :
            $header_id = str_replace(" ", "-", $edit_result['name']);
            header("location:/teste-fortunato/dashboard#$header_id");
            $edit_message_success = "O Contato foi alterado com sucesso!";
        endif;
    endif;
endif;
