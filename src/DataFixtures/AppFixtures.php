<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager)
    {
        // * Fixture particulière parent
        $parent = $this-> createUserFixture(email: 'partenaire@exemple.com',password:'partenaire', name:'Toulouse', address:'', activated:'true', role:'ROLE_PARTENAIRE' ,parent: null, manager: $manager);
        $parent2 = $this-> createUserFixture(email: 'partenaire2@exemple.com',password:'partenaire', name:'Paris', address:'', activated:'true', role:'ROLE_PARTENAIRE' ,parent: null, manager: $manager);
        $parent3 = $this-> createUserFixture(email: 'partenaire3@exemple.com',password:'partenaire', name:'Lyon', address:'', activated:'true', role:'ROLE_PARTENAIRE' ,parent: null, manager: $manager);
        // * autres fixtures user
        $this-> createUserFixture(email: 'administrateur@exemple.com',password:'administrateur', name:'Philippe', address:'', activated:'true', role:'ROLE_ADMINISTRATEUR' ,parent: null, manager: $manager);
        $this-> createUserFixture(email: 'administrateur2@exemple.com',password:'administrateur2', name:'OLivier', address:'', activated:'true', role:'ROLE_ADMINISTRATEUR' ,parent: null, manager: $manager);
        $this-> createUserFixture(email: 'structure@exemple.com',password:'structure', name:'', address:'rue de cugnaux ', activated:'true', role:'ROLE_STRUCTURE' ,parent:$parent, manager: $manager);
        $this-> createUserFixture(email: 'structure3@exemple.com',password:'structure', name:'', address:'rue de bayard', activated:'true', role:'ROLE_STRUCTURE' ,parent:$parent, manager: $manager);
        $this-> createUserFixture(email: 'structure2@exemple.com',password:'structure', name:'', address:'rue de la Paix', activated:'true', role:'ROLE_STRUCTURE' ,parent:$parent2, manager: $manager);
        $this-> createUserFixture(email: 'structure4@exemple.com',password:'structure', name:'', address:'rue de Rivoli', activated:'', role:'ROLE_STRUCTURE' ,parent:$parent2, manager: $manager);
        $this-> createUserFixture(email: 'structureout@exemple.com',password:'structure', name:'', address:'rue de la colombette', activated:'', role:'ROLE_STRUCTURE' ,parent:$parent, manager: $manager);
        $this-> createUserFixture(email: 'structure5@exemple.com',password:'structure', name:'', address:'rue du paradis ', activated:'true', role:'ROLE_STRUCTURE' ,parent:$parent3, manager: $manager);
        $this-> createUserFixture(email: 'structure6@exemple.com',password:'structure', name:'', address:'rue de la soif', activated:'true', role:'ROLE_STRUCTURE' ,parent:$parent3, manager: $manager);
        $this-> createUserFixture(email: 'structure7@exemple.com',password:'structure', name:'', address:'rue du peuple', activated:'true', role:'ROLE_STRUCTURE' ,parent:$parent3, manager: $manager);
        $this-> createUserFixture(email: 'structure8@exemple.com',password:'structure', name:'', address:'rue de sevre', activated:'', role:'ROLE_STRUCTURE' ,parent:$parent3, manager: $manager);
        $this-> createUserFixture(email: 'structure9@exemple.com',password:'structure', name:'', address:'rue du touch', activated:'', role:'ROLE_STRUCTURE' ,parent:$parent3, manager: $manager);

        $manager->flush();
    }

    //* Fonction création de fixture pour user
    public function createUserFixture(string $email,string $password, string $name, string $address, string $activated, string $role  ,User $parent = null, ObjectManager $manager ){
        $user = new User();
        $user  
                ->setEmail($email)
                ->setPassword($this->hasher->hashPassword($user, $password))
                ->setName($name)
                ->setAddress($address)
                ->setActivated($activated)
                ->setRoles([$role])
                ->setParent($parent);

        $manager->persist($user);

        return $user; // pour la fonction parent
    }
}