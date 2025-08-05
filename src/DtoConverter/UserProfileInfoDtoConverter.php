<?php
namespace App\DtoConverter;

use App\Entity\User;
use App\Dto\UserProfileInfoDto;
use App\Dto\UserEvenementDto;


class UserProfileInfoDtoConverter {

    public function convertToDto(User $user): UserProfileInfoDto
    {
        $userDto = new UserProfileInfoDto();
        $userDto->setId($user->getId());
        $userDto->setFirstName($user->getFirstName());
        $userDto->setLastName($user->getLastName());
        $userDto->setEmail($user->getEmail());
        $userDto->setPhoneNumber($user->getPhoneNumber());
        $userDto->setPicture($user->getPicture());
       

        return $userDto;
    }

    public function convertToEntity(UserProfileInfoDto $userDto): User
    {
        $user = new User();
        $user->setFirstName($userDto->getFirstName());
        $user->setLastName($userDto->getLastName());
        $user->setEmail($userDto->getEmail());
        $user->setPhoneNumber($userDto->getPhoneNumber());
        $user->setPicture($userDto->getPicture());      

        return $user;
    }
}