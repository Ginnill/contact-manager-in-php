<?php

require "db.php";

$contact_query = $conn->query('SELECT `id`, `name`, `email`, `image`, `phone` FROM contacts');

$contact_query->execute();

$contacts = $contact_query->fetchAll();
