<?php

declare(strict_types=1);

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class NipValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof Nip) {
            throw new UnexpectedTypeException($constraint, Nip::class);
        }

        if ($value === null || $value === '') {
            return;
        }

        if (!\is_scalar($value) && !$value instanceof \Stringable) {
            $this->context->buildViolation($constraint->message)->addViolation();
            return;
        }

        $digits = preg_replace('/\\D+/', '', (string) $value);
        if ($digits === null) {
            $this->context->buildViolation($constraint->message)->addViolation();
            return;
        }

        if (strlen($digits) !== 10) {
            $this->context->buildViolation($constraint->message)->addViolation();
            return;
        }

        $weights = [6, 5, 7, 2, 3, 4, 5, 6, 7];
        $sum = 0;
        for ($i = 0; $i < 9; $i++) {
            $sum += (int) $digits[$i] * $weights[$i];
        }

        $checksum = $sum % 11;
        if ($checksum === 10) {
            $checksum = 0;
        }

        if ($checksum !== (int) $digits[9]) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}
