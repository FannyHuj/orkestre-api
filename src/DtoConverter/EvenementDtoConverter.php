<?php

namespace App\DtoConverter;

use App\Entity\Evenement;
use App\Dto\EvenementDto;
use App\Dto\UserDto;


class EvenementDtoConverter {

   

     public function convertToDto(Evenement $evenement): EvenementDto
    {
        $evenementDto = new EvenementDto();
        $evenementDto->setId($evenement->getId());
        $evenementDto->setTitle($evenement->getTitle());
        $evenementDto->setDescription($evenement->getDescription());
        $evenementDto->setEvenementDate($evenement->getEvenementDate());
        $evenementDto->setLocation($evenement->getLocation());
        $evenementDto->setMaxCapacity($evenement->getMaxCapacity());
        $evenementDto->setPrice($evenement->getPrice());
        $evenementDto->setCategory($evenement->getCategory());
        $evenementDto->setCountParticipants($evenement->getParticipants()->count());
        $evenementDto->setRemainingCapacity($evenement->getMaxCapacity() - $evenement->getParticipants()->count());

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


        return $evenementDto;
    }

    public function convertToEntity(EvenementDto $evenementDto): Evenement
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