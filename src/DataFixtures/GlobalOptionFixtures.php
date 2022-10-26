<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Faker\Generator;
use App\Entity\GlobalOption;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;



class GlobalOptionFixtures extends Fixture

{
    /**
     * @var Generator
     */
    private Generator $faker;



    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
        $this->faker = Factory::create('fr_FR');
    }

    
    public function load(ObjectManager $manager): void
    {

        for ($i=0; $i<=10; $i++) {
            $fakePartenaire = new User();
            $fakePartenaire
                ->setName($this->faker->city)
                ->setEmail($this->faker->email)
                ->setPassword($this->hasher->hashPassword($fakePartenaire, 'partenaire'))
                ->setRoles(['ROLE_PARTENAIRE'])
                ->setActivated(True);

            $manager->persist($fakePartenaire);

            $fakeStructure = new User();
            $fakeStructure
                ->setAddress($this->faker->streetName)
                ->setEmail($this->faker->email)
                ->setPassword($this->hasher->hashPassword($fakeStructure, 'structure'))
                ->setRoles(['ROLE_STRUCTURE'])
                ->setParent($fakePartenaire)
                ->setActivated(True);

            $manager->persist($fakeStructure);

            $nameGlobalOption = [
                "Vendre des boissons",
                "Inscrit à la News Letter",
                "Recevoir des goodies",
                "Gérer les planning équipe"
            ];

            

            for ($j=0; $j<=3; $j++) {
                $globaleOption= new GlobalOption();
                $globaleOption ->setName($nameGlobalOption[$j])
                        ->setPatnerParent($fakePartenaire)
                        ->setActivated(mt_rand(0,1))
                ;
                $manager->persist($globaleOption);

            }  
        }
        $manager->flush();
    }
    
}


/*         
        //* fixtures GlobalOption
        $this-> createGlobalOptionFixture(name:'Philippe', activated:'true', idPartner: null, manager: $manager);

        $manager->flush();
    }

    //* Fonction création de fixture pour GlobalOption
    public function createGlobalOptionFixture(string $name, string $activated, ,User $idPartner = null, ObjectManager $manager ){
        $globalOption = new GlobalOption();
        $globalOption  
                ->setName($name)
                ->setActivated($activated)
                ->addIdPartner($idPartner);

        $manager->persist($globalOption);

        return $globalOption; // pour la fonction parent */