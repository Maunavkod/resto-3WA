<?php

class UserSession
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    public function create($userId, $firstName, $lastName, $email)
    {
        $_SESSION['user'] = [
            'id'        => $userId,
            'firstName' => $firstName,
            'lastName'  => $lastName,
            'email'     => $email,
        ];
        session_regenerate_id(true);
    }
    
    public function isAuthentificated(): bool
    {
        return array_key_exists('user', $_SESSION);
    }
    
    public function __toString(): string
    {
        return $this->getFullName();
    }
    
    public function destroy(): void
    {
        session_regenerate_id(true);
        $_SESSION = [];
        session_destroy();
    }
    
    public function getId(): ?string
    {
        if (!$this->isAuthentificated()){
            return null;
        }
        return $_SESSION['user']['id'];
    }
    
    public function getFirstName(): ?string
    {
        if (!$this->isAuthentificated()){
            return null;
        }
        return $_SESSION['user']['firstName'];
    }
    
    public function getLastName(): ?string
    {
        if (!$this->isAuthentificated()){
            return null;
        }
        return $_SESSION['user']['lastName'];
    }
    
     public function getFullName(): ?string
    {
        if (!$this->isAuthentificated()){
            return null;
        }
        return "{$_SESSION['user']['firstName']} {$_SESSION['user']['firstName']}";
    }
    
    public function getEmail(): ?string
    {
        if (!$this->isAuthentificated()){
            return null;
        }
        return $_SESSION['user']['email'];
    }
}