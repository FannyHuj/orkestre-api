<?php
namespace App\Services;

use App\Repository\EvenementRepository;
use App\Repository\UserRepository;

class EvenementService {

    private EvenementRepository $evenementRepository;
    private UserRepository $userRepository;

    
    public function __construct(UserRepository $userRepository, EvenementRepository $evenementRepository)
    {
        $this->evenementRepository = $evenementRepository;
        $this->userRepository = $userRepository;
    }

    public function bookingEvenement($evenementId, $userId)
    {
       $evenement= $this->evenementRepository->findEvenementById($evenementId);
       $user=$this->userRepository->findUserById($userId);

        if ($this->isCompleted($evenement)){}

       $evenement->addParticipant($user);
       $this->evenementRepository->save($evenement);
    

    }

    public function cancelEvenement($evenementId, $userId)
    {
        $evenement= $this->evenementRepository->findEvenementById($evenementId);
        $user=$this->userRepository->findUserById($userId);

        $this->evenementRepository->cancelEvenementByOrganizer($evenement, $user);
    }

    public function cancelRegistration ($evenementId, $userId){
     $evenement = $this->evenementRepository->findEvenementById($evenementId);
     $user = $this->userRepository->findUserById($userId); 
     $evenement->removeParticipant($user);
     $this->evenementRepository->save($evenement);   
    }

    public function isCompleted($evenement){
       if (count($evenement->getParticipants()) == $evenement->getMaxCapacity()){
        return true;     
       } 
       else {
        return false;
       }
    }

     
}