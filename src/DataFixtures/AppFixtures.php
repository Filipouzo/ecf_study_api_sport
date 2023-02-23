<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Option;
use App\Entity\GlobalOption;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Component\Security\Core\Role\Role;
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

        $parent = $this-> createUserFixturePartenaire(email: 'partenaire@exemple.com',password:'partenaire', name:'Toulouse', address:'', activated:'true', role:'ROLE_PARTENAIRE' ,parent: null, manager: $manager);
        $parent2 = $this-> createUserFixturePartenaire(email: 'partenaire2@exemple.com',password:'partenaire', name:'Paris', address:'', activated:'true', role:'ROLE_PARTENAIRE' ,parent: null, manager: $manager);
        $parent3 = $this-> createUserFixturePartenaire(email: 'partenaire3@exemple.com',password:'partenaire', name:'Lyon', address:'', activated:'true', role:'ROLE_PARTENAIRE' ,parent: null, manager: $manager);
        
        
        // * autres fixtures user
        $this-> createUserFixture(email: 'administrateur@exemple.com',password:'administrateur', name:'Philippe', address:'', activated:'true', role:'ROLE_ADMINISTRATEUR' ,parent: null, manager: $manager);
        $this-> createUserFixture(email: 'administrateur2@exemple.com',password:'administrateur2', name:'Olivier', address:'', activated:'true', role:'ROLE_ADMINISTRATEUR' ,parent: null, manager: $manager);
        $this-> createUserFixture(email: 'administrateur3@exemple.com',password:'administrateur3', name:'Edouard', address:'', activated:'true', role:'ROLE_ADMINISTRATEUR' ,parent: null, manager: $manager);
        $this-> createUserFixtureStructure(email: 'structure@exemple.com',password:'structure', name:'', address:'rue de cugnaux ', activated:'true', role:'ROLE_STRUCTURE' ,parent:$parent, manager: $manager);
        $this-> createUserFixtureStructure(email: 'structure3@exemple.com',password:'structure', name:'', address:'rue de bayard', activated:'true', role:'ROLE_STRUCTURE' ,parent:$parent, manager: $manager);
        $this-> createUserFixtureStructure(email: 'structure2@exemple.com',password:'structure', name:'', address:'rue de la Paix', activated:'true', role:'ROLE_STRUCTURE' ,parent:$parent2, manager: $manager);
        $this-> createUserFixtureStructure(email: 'structure4@exemple.com',password:'structure', name:'', address:'rue de Rivoli', activated:'', role:'ROLE_STRUCTURE' ,parent:$parent2, manager: $manager);
        $this-> createUserFixtureStructure(email: 'structureout@exemple.com',password:'structure', name:'', address:'rue de la colombette', activated:'', role:'ROLE_STRUCTURE' ,parent:$parent, manager: $manager);
        $this-> createUserFixtureStructure(email: 'structure5@exemple.com',password:'structure', name:'', address:'rue du paradis ', activated:'true', role:'ROLE_STRUCTURE' ,parent:$parent3, manager: $manager);
        $this-> createUserFixtureStructure(email: 'structure6@exemple.com',password:'structure', name:'', address:'rue de la soif', activated:'true', role:'ROLE_STRUCTURE' ,parent:$parent3, manager: $manager);
        $this-> createUserFixtureStructure(email: 'structure7@exemple.com',password:'structure', name:'', address:'rue du peuple', activated:'true', role:'ROLE_STRUCTURE' ,parent:$parent3, manager: $manager);
        $this-> createUserFixtureStructure(email: 'structure8@exemple.com',password:'structure', name:'', address:'rue de sevre', activated:'', role:'ROLE_STRUCTURE' ,parent:$parent3, manager: $manager);
        $this-> createUserFixtureStructure(email: 'structure9@exemple.com',password:'structure', name:'', address:'rue du touch', activated:'', role:'ROLE_STRUCTURE' ,parent:$parent3, manager: $manager);
 
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


    public function createUserFixturePartenaire(string $email,string $password, string $name, string $address, string $activated, string $role  ,User $parent = null, ObjectManager $manager ){
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

        $nameGlobalOption = [
            "Vendre des boissons",
            "Inscrit à la News Letter",
            "Recevoir des goodies",
            "Gérer les planning équipe"
        ];
        

        for ($j=0; $j<=3; $j++) {
            $globaleOption= new GlobalOption();
            $globaleOption ->setName($nameGlobalOption[$j])
                    ->setPatnerParent($user)
                    ->setActivated(mt_rand(0,1))
            ;
            $manager->persist($globaleOption);

        }

        return $user; // pour la fonction parent
    }

    public function createUserFixtureStructure(string $email,string $password, string $name, string $address, string $activated, string $role  ,User $parent = null, ObjectManager $manager ){
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

        $nameGlobalOption = [
            "Vendre des boissons",
            "Inscrit à la News Letter",
            "Recevoir des goodies",
            "Gérer les planning équipe"
        ];
        

        for ($j=0; $j<=3; $j++) {
            
            $option= new Option();
            $option ->setName($nameGlobalOption[$j])
                    ->setStructureParent($user)
                    ->setActivated(mt_rand(0,1))
            ;
            $manager->persist($option);

        }

        return $user; // pour la fonction parent
    }
}