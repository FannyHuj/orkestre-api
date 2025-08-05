<?php

namespace App\Tests\Unit;
use App\Entity\Evenement;
use App\Entity\User;
use App\Services\EvenementService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class EvenementServiceTest extends KernelTestCase
{

     private EvenementService $evenementService; 
     protected function setUp(): void
    {
        $this->evenementService = self::getContainer()->get(EvenementService::class);
    }

    public function testIsCompleted(): void
    {

        $evenement = new Evenement();
        $evenement->setMaxCapacity(3);

        $user = new User();
        $user->setFirstName('Tom');
        $evenement->addParticipant($user); 

        $user2 = new User();
        $user2->setFirstName('Lisa');
        $evenement->addParticipant($user2); 

        $user3 = new User();
        $user3->setFirstName('Alice');
        $evenement->addParticipant($user3);

        $this->assertTrue($this->evenementService->isCompleted($evenement));
    }
}


