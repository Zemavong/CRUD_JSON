<?php

include 'partials/header.php';
require __DIR__ . '/users/users.php';

if (!isset($_GET['id'])) {
    include "partials/not_found.php";
    exit;
}

$userId = $_GET['id'];
$user = getUserByid($userId);

if (!$user) {
    include 'partials/not_found.php';
    exit;
}

$errors = [
    'name' => 'The username is mandatory',
    'username' => '',
    'email' => '',
    'phone' => '',
    'website' => '',
];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = array_merge($user, $_POST);

    $isValid = validateUser($user, $errors);

    if ($isValid) {
        $user = updateUser($_POST, $userId);
        uploadImage($_FILES['pictures'], $user);

        header('Location: index.php');
    }
}

?>

<?php include '_form.php' ?>