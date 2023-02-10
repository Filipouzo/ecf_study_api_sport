<?php

use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Validation;

class EmailValidationTest extends TestCase
{
    public function testInvalidEmail()
    {
        $validator = Validation::createValidator();
        $errors = $validator->validate('pasUnEmail', [
            new Email(),
        ]);

        $this->assertGreaterThan(0, count($errors), 'Un Email incorrect peut être rentré !');
    }
}