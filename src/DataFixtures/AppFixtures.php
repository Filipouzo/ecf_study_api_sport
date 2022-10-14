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
        $admin  ->setEmail("administrateur@exemple.com")
                ->setPassword($this->hasher->hashPassword($admin, 'administrateur'))
                ->setActivated('true')
                ->setRoles(['ROLE_ADMINISTRATEUR']);

        $manager->persist($admin);

        $partenaire = new User();
        $partenaire  ->setEmail("partenaire@exemple.com")
                ->setPassword($this->hasher->hashPassword($admin, 'partenaire'))
                ->setName("partenaire")
                ->setActivated('true')
                ->setRoles(['ROLE_PARTENAIRE']);
    
        $manager->persist($partenaire);

        $structurein = new User();
        $structurein  ->setEmail("structurein@exemple.com")
                ->setPassword($this->hasher->hashPassword($admin, 'structure'))
                ->setName("structurein")
                ->setActivated('true')
                ->setRoles(['ROLE_STRUCTURE']);
    
        $manager->persist($structurein);

        $structureout = new User();
        $structureout  ->setEmail("structureout@exemple.com")
                ->setPassword($this->hasher->hashPassword($admin, 'structure'))
                ->setName("structureout")
                /* ->setActivated('true') */
                ->setRoles(['ROLE_STRUCTURE']);
    
        $manager->persist($structureout);

        $manager->flush();
    }

}
