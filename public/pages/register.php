<?php
session_start();
require_once '../model/server.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $connector = new Connector();
    
    if (isset($_POST['action']) && $_POST['action'] === 'update') {
        // Get and sanitize input for update
        $admin_id = isset($_POST['admin_id']) ? trim($_POST['admin_id']) : '';
        $new_username = isset($_POST['new_username']) ? trim($_POST['new_username']) : '';
        $current_password = isset($_POST['current_password']) ? trim($_POST['current_password']) : '';
        $new_password = isset($_POST['new_password']) ? trim($_POST['new_password']) : '';

        if (empty($admin_id)) {
            $_SESSION['error'] = "Admin ID is missing.";
            header("Location: ../views/settings.php");
            exit();
        }

        // Debug line - remove in production
        error_log("Admin ID: $admin_id, New Username: $new_username, Current Password: " . (!empty($current_password) ? 'set' : 'not set'));

        // Verify current password
        $verify_sql = "SELECT admin_id, admin_password FROM admin_tb WHERE admin_id = ?";
        $verify_stmt = $connector->executeQuery($verify_sql, [$admin_id]);
        $admin = $verify_stmt->fetch(PDO::FETCH_ASSOC);

        if (!$admin) {
            $_SESSION['error'] = "Admin account not found.";
            header("Location: ../views/settings.php");
            exit();
        }

        if (!password_verify($current_password, $admin['admin_password'])) {
            $_SESSION['error'] = "Current password is incorrect!";
            header("Location: ../views/settings.php");
            exit();
        }

        try {
            $updates = [];
            $params = [];

            // Check and add username update
            if (!empty($new_username)) {
                $updates[] = "admin_username = ?";
                $params[] = $new_username;
            }

            // Check and add password update
            if (!empty($new_password)) {
                $updates[] = "admin_password = ?";
                $params[] = password_hash($new_password, PASSWORD_DEFAULT);
            }

            if (empty($updates)) {
                $_SESSION['error'] = "No changes requested.";
                header("Location: ../views/settings.php");
                exit();
            }

            $params[] = $admin_id;
            $update_sql = "UPDATE admin_tb SET " . implode(", ", $updates) . " WHERE admin_id = ?";
            $result = $connector->executeQuery($update_sql, $params);

            if ($result) {
                if (!empty($new_username)) {
                    $_SESSION['admin_username'] = $new_username;
                }
                $_SESSION['success'] = "Account updated successfully!";
            } else {
                $_SESSION['error'] = "Failed to update account.";
            }
        } catch (PDOException $e) {
            $_SESSION['error'] = "Database error: " . $e->getMessage();
        }
        
        header("Location: ../views/settings.php");
        exit();
    } else {
        // Original registration code remains here...
    }
}
?>