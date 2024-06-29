<?php

declare(strict_types=1);

namespace Application\Controller\Security\SignUp;

use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\PasswordStrength;

final readonly class Payload
{
    public function __construct(
        #[NotBlank(message: 'Missing email value')]
        #[Email(message: 'Invalid email format')]
        public string $email,

        #[NotBlank(message: 'Missing password value')]
        #[PasswordStrength]
        public string $password
    ) {
    }
}
