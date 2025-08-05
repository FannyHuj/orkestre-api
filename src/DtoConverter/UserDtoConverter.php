<?php
namespace App\DtoConverter;

use App\Entity\User;
use App\Dto\UserDto;
use App\Dto\EvenementDto;

class UserDtoConverter {

    public function convertToDto(User $user): UserDto
    {
        $userDto = new UserDto();
        $userDto->setId($user->getId());
        $userDto->setFirstName($user->getFirstName());
        $userDto->setLastName($user->getLastName());
        $userDto->setEmail($user->getEmail());
        $userDto->setPicture($user->getPicture());
        $userDto->setRoles($user->getRoles());
        $userDto->setPhoneNumber($user->getPhoneNumber());
       

        return $userDto;
    }

    public function convertToEntity(UserDto $userDto): User
    {
        $user = new User();
        $user->setFirstName($userDto->getFirstName());
        $user->setLastName($userDto->getLastName());
        $user->setEmail($userDto->getEmail());
        $user->setPassword($userDto->getPassword()); 
        $user->setPicture($userDto->getPicture());
        $user->setPhoneNumber($userDto->getPhoneNumber());
        
        $userRole=$userDto->getRoles();
        $roles = $user->getRoles();
        $roles[] = reset($userRole);
        $user->setRoles($roles);


        return $user;
    }
}