<?php

namespace App\DtoConverter;

use App\Entity\Evenement;
use App\Dto\EvenementMinDto;
use App\Dto\UserDto;
use App\Services\EvenementService;

class EvenementMinDtoConverter {

     var EvenementService $evenementService;

    public function __construct($evenementService){
        $this->evenementService = $evenementService;

    }

         public function convertToDto(Evenement $evenement): EvenementMinDto
    {
        $evenementDto = new EvenementMinDto();
        $evenementDto->setId($evenement->getId());
        $evenementDto->setTitle($evenement->getTitle());
        $evenementDto->setDescription($evenement->getDescription());
        $evenementDto->setEvenementDate($evenement->getEvenementDate());
        $evenementDto->setLocation($evenement->getLocation());
        $evenementDto->setMaxCapacity($evenement->getMaxCapacity());
        $evenementDto->setPrice($evenement->getPrice());
        $evenementDto->setCategory($evenement->getCategory());
        $evenementDto->setCountParticipants($evenement->getParticipants()->count());

        $user = new UserDto();
        $user->setId($evenement->getOrganizer()->getId());
        $user->setFirstName($evenement->getOrganizer()->getFirstName());
        $user->setLastName($evenement->getOrganizer()->getLastName());
        $user->setEmail($evenement->getOrganizer()->getEmail());
        $user->setPicture($evenement->getOrganizer()->getPicture());
        $user->setPhoneNumber($evenement->getOrganizer()->getPhoneNumber());
        $user->setRoles($evenement->getOrganizer()->getRoles());
        $user->setPassword($evenement->getOrganizer()->getPassword());

        $evenementDto->setOrganizer($user);

        $evenementDto->setIsCompleted($this->evenementService->isCompleted($evenement));
        

        return $evenementDto;
    }

    public function convertToEntity(EvenementMinDto $evenementDto): Evenement
    {
        $evenement = new Evenement();
        $evenement->setTitle($evenementDto->getTitle());
        $evenement->setDescription($evenementDto->getDescription());
        $evenement->setEvenementDate($evenementDto->getEvenementDate());
        $evenement->setLocation($evenementDto->getLocation()); 
        $evenement->setMaxCapacity($evenementDto->getMaxCapacity());
        $evenement->setPrice($evenementDto->getPrice());
        $evenement->setCategory($evenementDto->getCategory());
        

        return $evenement;
    }

}