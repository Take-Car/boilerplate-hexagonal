<?php

declare(strict_types=1);

namespace Application\Controller\Auth\DTO;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class AuthRequest
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Length(min: 8, max: 64)]
        public string $username,

        #[Assert\NotBlank]
        #[Assert\PasswordStrength]
        #[Assert\NotCompromisedPassword]
        public string $password,
    ) {
    }
}
