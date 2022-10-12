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
                ->setPassword($this->hasher->hashPassword($admin, 'administrateur'))
                ->setRoles(['ROLE_ADMINISTRATEUR']);

        $manager->persist($admin);

        $partenaire = new User();
        $partenaire  ->setEmail("partenaire@exemple.com")
                ->setPassword($this->hasher->hashPassword($admin, 'partenaire'))
                ->setName("partenaire")
                ->setRoles(['ROLE_PARTENAIRE']);
    
        $manager->persist($partenaire);

        $structure = new User();
        $structure  ->setEmail("structure@exemple.com")
                ->setPassword($this->hasher->hashPassword($admin, 'structure'))
                ->setName("structure")
                ->setRoles(['ROLE_STRUCTURE']);
    
        $manager->persist($structure);

        $manager->flush();
    }

}
