<?php

namespace App\DataFixtures;

use App\Entity\Cat;
use App\Entity\Hosting;
use App\Entity\Owner;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class OwnerFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Instanciation de la classe Faker
        // On peut utiliser la langue française en passant en paramètre à create : create('fr_FR')
        $faker = Faker\Factory::create();

        // Création de propriétaires (entre 5 et 10)
        for ($i = 0; $i < mt_rand(5, 10); $i++) {
            $owner = new Owner();
            $owner->setFirstName($faker->firstName())
                ->setLastName($faker->lastName())
                ->setTitle($faker->title('male' | 'female'))
                ->setEmail($faker->freeEmail())
                ->setPhoneNumber($faker->phoneNumber())
                ->setAddressLine1($faker->streetAddress())
                ->setCity($faker->city())
                ->setPostCode($faker->postcode());

            // Création de chats pour chaque propriétaire (entre 1 et 3)
            for ($j = 0; $j < mt_rand(1, 3); $j++) {
                $cat = new Cat();
                $cat->setName($faker->firstName())
                    ->setBirthday($faker->dateTimeBetween('-12 years', 'now'))
                    ->setSex($faker->randomElement(array('male', 'femelle')))
                    ->setComments($faker->text)
                    ->setPicture(base64_encode(file_get_contents('https://picsum.photos/100/75')));

                // Création d'hébergements pour chaque chat (entre 0 et 5)
                for ($k = 0; $k < mt_rand(0, 5); $k++) {
                    $hosting = new Hosting();
                    $startDate = $faker->dateTimeBetween('-3 years', 'now');
                    $hosting->setStartDate($startDate)
                        ->setEndDate($faker->dateTimeBetween($startDate, 'now'))
                        ->setAmount($faker->numberBetween(20,200));
                    $cat->addHosting($hosting);
                    $manager->persist($hosting);
                }
                $owner->addCat($cat);
                $manager->persist($cat);
            }
            $manager->persist($owner);
        }

        $manager->flush();
    }
}
