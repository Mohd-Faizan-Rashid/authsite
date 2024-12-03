<?php
session_start();

header("Content-Type: application/json");

$input = json_decode(file_get_contents("php://input"), true);

if (isset($input['action'])) {
    switch ($input['action']) {
        case 'login':
        case 'register':
            $_SESSION['user'] = $input['user'];
            echo json_encode(['success' => true]);
            break;
        case 'updateProfile':
            if (isset($_SESSION['user'])) {
                $_SESSION['user']['displayName'] = $input['user']['displayName'];
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'User not logged in']);
            }
            break;
        default:
            echo json_encode(['success' => false, 'error' => 'Invalid action']);
            break;
    }
} else {
    echo json_encode(['success' => false, 'error' => 'No action specified']);
}
?>

To host this on Render:

1. Create a `composer.json` file in the root directory:

```json
{
    "require": {
        "php": "^7.4"
    }
}
