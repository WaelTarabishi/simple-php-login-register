<?php

class LoginValidator
{
    public function validate(string $email, string $password): array
    {
        $errors = [];

        if ($email === '') {
            $errors[] = 'Email is required.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Please enter a valid email.';
        }

        if ($password === '') {
            $errors[] = 'Password is required.';
        }

        return $errors;
    }
}
