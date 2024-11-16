<?php
function validateForm($username, $email, $password, $confirmPassword = null)
{
    if (!validateEmail($email)) {
        return "Invalid email format";
    }

    if (!validateUsername($username)) {
        return "Username must be 3 to 15 characters long and contain only letters, numbers, and underscores";
    }

    if (!validatePassword($password)) {
        return "Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, and one digit";
    }

    if ($confirmPassword !== null && $password !== $confirmPassword) {
        return "Passwords do not match";
    }

    return null;
}

function validateEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function validateUsername($username)
{
    // Username should be 3-15 characters and consist of letters, numbers, and underscores
    return preg_match('/^[a-zA-Z0-9_]{3,15}$/', $username);
}

function validatePassword($password)
{
    // Password must have at least one uppercase, one lowercase, one number, and be 8+ characters
    return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $password);
}
