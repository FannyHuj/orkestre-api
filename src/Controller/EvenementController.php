<?php

namespace App\Controller;

use App\Dto\EvenementDto;
use App\DtoConverter\EvenementDtoConverter;
use App\DtoConverter\EvenementMinDtoConverter;
use App\Repository\EvenementRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Dto\EvenementFiltersDto;
use DateTime;
use App\Services\EvenementService;
use Psr\Log\LoggerInterface;

class EvenementController extends AbstractController
{
  #[Route('/api/createEvenement', methods: ['POST'])]
public function new(
    #[MapRequestPayload] EvenementDto $evenementDto,
    EvenementRepository $evenementRepository,
    UserRepository $userRepository,
): JsonResponse {
    $converter = new EvenementDtoConverter();

    // Convert DTO to Entity
    $evenement = $converter->convertToEntity($evenementDto);

    // Get organizer (UserDto)
    $organizerDto = $evenementDto->getOrganizer();
    if (!$organizerDto || !$organizerDto->getId()) {
        return $this->json(['status' => 'error', 'message' => 'Organizer manquant ou invalide'], 400);
    }

    // Get user entity from the ID
    $organizer = $userRepository->find($organizerDto->getId());
    if (!$organizer) {
        return $this->json(['status' => 'error', 'message' => 'Utilisateur non trouvé'], 404);
    }

    // Associate the organizer to the evenement 
    $evenement->setOrganizer($organizer);

    // Save the evenement 
    $evenementRepository->save($evenement, true);

    return $this->json(['status' => 'success']);
}


    #[Route('/api/getAllEvenements')]
    public function getAllEvenements (EvenementRepository $evenementRepository, EvenementService $evenementService): JsonResponse{

        $evenements= $evenementRepository->findAllEvenements();

        $convert=new EvenementMinDtoConverter($evenementService);
        $dtoList = [];

        foreach($evenements as $evenement){
            array_push($dtoList, $convert->convertToDto($evenement));
        }

        return $this->json($dtoList, 200, [], ['json_encode_options' => JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES]);
    }

    #[Route('/api/getFilteredEvenements', methods: ['GET'])]
    public function getFilteredEvenements(LoggerInterface $logger, Request $request, EvenementRepository $evenementRepository, EvenementService $evenementService): JsonResponse
    {
        $evenementFiltersDto = new EvenementFiltersDto();

         if($request->get("date") === "undefined" || $request->get("date") === "null"  || $request->get("date") === ""){
        
            $evenementFiltersDto->setDate(null);
        }else{
           $dateFromrequest=$request->get('date');
            $date=new DateTime($dateFromrequest);
            $dateFormat=$date->format('Y-m-d H:i:s');
            $evenementFiltersDto->setDate(new DateTime($dateFormat));
        }
        
        if($request->get("priceMax") === "undefined" || $request->get("priceMax") === "null"  || $request->get("priceMax") === ""){
        
            $evenementFiltersDto->setPriceMax(0);
        }else{
            $evenementFiltersDto->setPriceMax($request->get('priceMax'));
        }
      
        //$categoryString = $request->get('category');
        //$categoryEnum = EvenementCategoryEnum::tryFrom(strtoupper($categoryString));
        
        $logger->debug('Category from request: ' . $request->get('category'));
        if($request->get('category') === 'undefined'){
            $evenementFiltersDto->setCategory(null);
        }else{  
            $evenementFiltersDto->setCategory($request->get('category'));
        }

        $evenements = $evenementRepository->findFilteredEvenements($evenementFiltersDto);

         $convert=new EvenementMinDtoConverter($evenementService);
         $dtoList = [];

        foreach($evenements as $evenement){
            array_push($dtoList, $convert->convertToDto($evenement));
        }

        return $this->json($dtoList, 200, [], ['json_encode_options' => JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES]);
    }

    #[Route('/api/findEvenementById/{id}')]
    public function showEvenementDetails (EvenementRepository $evenementRepository,$id, EvenementService $evenementService): JsonResponse{

        $evenement = $evenementRepository->findEvenementById($id);

        $converter = new EvenementDtoConverter();
        $evenementDto = $converter->convertToDto($evenement);
        

        return $this->json($evenementDto, 200, [], ['json_encode_options' => JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES]);

    }

    #[Route('/api/evenementRegistrationByUser/{id}/user/{userId}', methods:['POST'])]
    public function evenementRegistration ($id,$userId, EvenementService $evenementService): JsonResponse
    {
       $evenementService->bookingEvenement($id, $userId);

        return $this->json(['status' => 'success', 'message' => 'Inscription réussie'], 200);
    }

    #[Route('/api/cancelEvenementByOrganizer/{id}/user/{userId}', methods:['DELETE'])]
    public function cancel ($id, $userId,EvenementService $evenementService):JsonResponse{

        $evenementService->cancelEvenement($id,$userId);
        
        return $this->json(['status' => 'success']);
    }

    #[Route('/api/cancelRegistrationByUser/evenement/{id}/user/{userId}', methods:['DELETE'])]
    public function cancelRegistration ($id, $userId,EvenementService $evenementService):JsonResponse{

        $evenementService->cancelRegistration($id, $userId);
        
        return $this->json(['status' => 'success']);
    }

    

}
