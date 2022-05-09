<?php

require "db.php";

$delete_id = $_POST['delete-id'] ?? null;
$delete_btn = $_POST['delete-btn'] ?? null;
if (isset($delete_btn)) :

    //  running query

    $delete_query = "DELETE FROM contacts WHERE `id` = ?";

    $delete_statement = $conn->prepare($delete_query);

    $delete_statement->execute([
        $delete_id,
    ]);


    // get last contact to use id in url
    $last_query = "SELECT `name`, `id` FROM contacts ORDER BY id DESC LIMIT 1";

    $last_statement = $conn->prepare($last_query);

    $last_statement->execute();

    $last_result = $last_statement->fetch(PDO::FETCH_ASSOC);

    $last_name = str_replace(" ", "-", $last_result['name']);

    header("location:/teste-fortunato/dashboard#$last_name");

endif;
