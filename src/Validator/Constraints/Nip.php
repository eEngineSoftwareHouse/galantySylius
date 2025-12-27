<?php

declare(strict_types=1);

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Nip extends Constraint
{
    public string $message = 'Nieprawidłowy numer NIP.';

    public function validatedBy(): string
    {
        return static::class.'Validator';
    }
}
