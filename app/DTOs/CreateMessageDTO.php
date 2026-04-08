<?php

namespace App\DTOs;

class CreateMessageDTO
{
    public function __construct(
        public string $content,
        public string $email,
        public string $password,
    ) {
    }
}