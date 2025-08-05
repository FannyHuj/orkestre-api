<?php

namespace App\DataFixtures;

use App\Entity\Evenement;
use App\Entity\EvenementCategoryEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;

class AppFixtures extends Fixture
{
    private $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Creation of users 

        $alice = new User();
        $alice->setFirstName("Alice");
        $alice->setLastName("Dupont");
        $alice->setEmail("alice@orkestre.com");
        $alice->setPassword($this->userPasswordHasher->hashPassword($alice, 'password'));
        $alice->setPicture("alice.jpg");
        $alice->setPhoneNumber("0123456789");
        $alice->setRoles(['ROLE_USER']);
        $manager->persist($alice);

        $bob = new User();
        $bob->setFirstName("Bob");
        $bob->setLastName("Martin");
        $bob->setEmail("bob@orkestre.com");
        $bob->setPassword($this->userPasswordHasher->hashPassword($bob, 'password'));
        $bob->setPicture("bob.jpg");
        $bob->setPhoneNumber("0987654321");
        $bob->setRoles(['ROLE_USER']);
        $manager->persist($bob);

        $charlie = new User();
        $charlie->setFirstName("Charlie");
        $charlie->setLastName("Durand");
        $charlie->setEmail("charlie@orkestre.com");
        $charlie->setPassword($this->userPasswordHasher->hashPassword($charlie, 'password'));
        $charlie->setPicture("charlie.jpg");
        $charlie->setPhoneNumber("0123456789");
        $charlie->setRoles(['ROLE_USER']);
        $manager->persist($charlie);

        // Creation of organizer

        $david = new User();
        $david->setFirstName("David");
        $david->setLastName("Lefevre");
        $david->setEmail("david@orkestre.com");
        $david->setPassword($this->userPasswordHasher->hashPassword($david, 'password'));
        $david->setPicture("david.jpg");
        $david->setPhoneNumber("0987654321");
        $david->setRoles(['ROLE_ORGANIZER']);
        $manager->persist($david);

        $julie = new User();
        $julie->setFirstName("Julie");
        $julie->setLastName("Bernard");
        $julie->setEmail("julie@orkestre.com");
        $julie->setPassword($this->userPasswordHasher->hashPassword($julie, 'password'));
        $julie->setPicture("julie.jpg");
        $julie->setPhoneNumber("0123456789");
        $julie->setRoles(['ROLE_ORGANIZER']);
        $manager->persist($julie);

        $lucas = new User();
        $lucas->setFirstName("Lucas");
        $lucas->setLastName("Nguyen");
        $lucas->setEmail("lucas@orkestre.com");
        $lucas->setPassword($this->userPasswordHasher->hashPassword($lucas, 'password'));
        $lucas->setPicture("lucas.jpg");
        $lucas->setPhoneNumber("0987654321");
        $lucas->setRoles(['ROLE_ORGANIZER']);
        $manager->persist($lucas);

        // Creation of evenements
        $evenement1 = new Evenement();
        $evenement1->setTitle("Concert de Jazz");
        $evenement1->setDescription("Un concert de jazz avec des musiciens locaux.");
        $evenement1->setEvenementDate(new \DateTime('2023-11-01 20:00:00'));
        $evenement1->setLocation("Salle de Concert, Paris");
        $evenement1->setMaxCapacity(100);
        $evenement1->setPrice(20);
        $evenement1->setCategory(EvenementCategoryEnum::CONCERT);
        $evenement1->setOrganizer($david);
        $evenement1->addParticipant($alice);
        $manager->persist($evenement1);

        $evenement2 = new Evenement();
        $evenement2->setTitle("Exposition d'Art");
        $evenement2->setDescription("Une exposition d'art contemporain avec des artistes émergents.");
        $evenement2->setEvenementDate(new \DateTime('2023-11-05 10:00:00'));
        $evenement2->setLocation("Galerie d'Art, Paris");
        $evenement2->setMaxCapacity(50);
        $evenement2->setPrice(10);
        $evenement2->setCategory(EvenementCategoryEnum::CULTURE);
        $evenement2->setOrganizer($julie);
        $evenement2->addParticipant($bob);
        $evenement2->addParticipant($lucas);
        $manager->persist($evenement2);

        $evenement3 = new Evenement();
        $evenement3->setTitle("Atelier de Cuisine");
        $evenement3->setDescription("Un atelier de cuisine italienne pour apprendre à faire des pâtes fraîches.");
        $evenement3->setEvenementDate(new \DateTime('2023-11-10 15:00:00'));
        $evenement3->setLocation("Cuisine Collective, Paris");
        $evenement3->setMaxCapacity(20);
        $evenement3->setPrice(30);
        $evenement3->setCategory(EvenementCategoryEnum::CULINARY);
        $evenement3->setOrganizer($lucas);
        $evenement3->addParticipant($bob);
        $manager->persist($evenement3);

        $evenement4 = new Evenement();  
        $evenement4->setTitle("Marathon de Paris");
        $evenement4->setDescription("Un marathon à travers les rues de Paris, ouvert à tous les niveaux.");
        $evenement4->setEvenementDate(new \DateTime('2023-11-15 08:00:00'));
        $evenement4->setLocation("Paris, France");
        $evenement4->setMaxCapacity(5000);
        $evenement4->setPrice(50);
        $evenement4->setCategory(EvenementCategoryEnum::SPORT);
        $evenement4->setOrganizer($david);
        $manager->persist($evenement4);

        $evenement5 = new Evenement();
        $evenement5->setTitle("Conférence sur l'Intelligence Artificielle");
        $evenement5->setDescription("Une conférence sur les dernières avancées en intelligence artificielle.");
        $evenement5->setEvenementDate(new \DateTime('2023-11-20 14:00:00'));
        $evenement5->setLocation("Auditorium, Paris");
        $evenement5->setMaxCapacity(200);
        $evenement5->setPrice(15);
        $evenement5->setCategory(EvenementCategoryEnum::CONFERENCE);
        $evenement5->setOrganizer($julie);
        $manager->persist($evenement5);

        $manager->flush();
    }
}

