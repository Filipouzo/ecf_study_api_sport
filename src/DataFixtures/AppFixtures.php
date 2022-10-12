<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    // ...
    public function load(ObjectManager $manager)
    {
        $admin = new User();
        $admin  ->setEmail("admin@exemple.com")
                ->setPassword($this->hasher->hashPassword($admin, 'admin'))
                ->setRoles(['ROLE_ADMINISTRATEUR']);

        $manager->persist($admin);
        $manager->flush();
    }
}
