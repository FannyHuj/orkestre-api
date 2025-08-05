<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Dto\UserDto;
use App\DtoConverter\UserDtoConverter;
use App\DtoConverter\UserProfileInfoDtoConverter;
use App\Repository\UserRepository;
use App\Entity\UserRoleEnum;
use Psr\Log\LoggerInterface;
use App\DtoConverter\EvenementMinDtoConverter;
use App\Services\EvenementService;

class UserController extends AbstractController

{
    #[Route('/api/signIn', methods:['POST'])]
    public function signIn(Request $request, LoggerInterface $logger, UserRepository $userRepository,UserPasswordHasherInterface $passwordHasher): JsonResponse
    {
          $hasPicture =false;
       
        if ($request->files->has('picture')) {
            $hasPicture=true;
            $picture = $request->files->get('picture');
            $logger->debug('Picture file received', [
                'originalName' => $picture->getClientOriginalName(),
                'mimeType' => $picture->getMimeType(),
                'size' => $picture->getSize(),
            ]);

            // Check if the file is an image and validate its size
            if (!in_array($picture->getMimeType(), ['image/jpeg', 'image/png', 'image/gif'])) {
                return $this->json(['error' => 'Invalid image type'], 400);
            }
            //
            //if ($picture->getSize() > 8000000) { // 8 Mo
             //   return $this->json(['error' => 'Image size exceeds limit'], 400);
            //}

            // Rename the file to avoid conflicts
            $newFileName = uniqid() . '.' . $picture->guessExtension();
            $logger->debug('New file name', [
                'newFileName' => $newFileName,
            ]);
           
            $destination = $this->getParameter('kernel.project_dir') . '/public/assets/images';
            
            $picture->move($destination, $newFileName);
          
        } else {
            $logger->warning('No picture file received in form-data');
        }


        $userDto = new UserDto();
        $userDto->setFirstName($request->request->get('firstName'));
        $userDto->setLastName($request->request->get('lastName'));
        $userDto->setEmail($request->request->get('email'));
        $userDto->setPassword($request->request->get('password'));
        $userDto->setPhoneNumber($request->request->get('phoneNumber'));

         if($hasPicture){
            $userDto->setPicture($newFileName);
        }
        $userDto->setRoles([UserRoleEnum::USER]);

        $converter = new UserDtoConverter();
        $user = $converter->convertToEntity($userDto);
        $hashedPassword = $passwordHasher->hashPassword($user, $user->getPassword());
        $user->setPassword($hashedPassword);

        $userRepository->save($user);


        return $this->json(['status' => 'success']);
       
}

    #[Route('/api/user/{email}')]
    public function getMail ($email,UserRepository $userRepository):JsonResponse{
        $user = $userRepository->findUserByEmail($email);
        $convert=new UserDtoConverter();
        return $this->json($convert->convertToDto($user));
    }

    #[Route('/api/getProfileInfo/{id}', methods: ['GET'])]
    public function getProfileInfo ($id, UserRepository $userRepository):JsonResponse{
        $user = $userRepository->findUserById($id);
        $convert=new UserProfileInfoDtoConverter();
        return $this->json($convert->convertToDto($user), 200, [], ['json_encode_options' => JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES]);
      
    }

     #[Route('/api/updateProfileInfo/{id}', methods: ['POST'])]
    public function updateProfileInfos(Request $request,$id,UserRepository $userRepository,UserProfileInfoDtoConverter $converter): JsonResponse {

        $user = $userRepository->findUserById($id);
        
        $user->setFirstName($request->request->get('firstName'));
        $user->setLastName($request->request->get('lastName'));
        $user->setEmail($request->request->get('email'));
        $user->setPhoneNumber($request->request->get('phoneNumber'));
        $user->setPicture($request->request->get('picture'));
        $picture = $request->files->get('picture');
         if (!in_array($picture->getMimeType(), ['image/jpeg', 'image/png', 'image/gif'])) {
                return $this->json(['error' => 'Invalid image type'], 400);
            }
        $newFileName = uniqid() . '.' . $picture->guessExtension();
        $destination = $this->getParameter('kernel.project_dir') . '/public/assets/images';
        $picture->move($destination,$newFileName);
        $user->setPicture($newFileName);
      
        $userRepository->save($user);

        return $this->json($converter->convertToDto($user),200,[], ['json_encode_options' => JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES]);
    }

     #[Route('/api/findEvenementByUserId/{userId}', methods: ['GET'])]
    public function findEvenementByUserId($userId, UserRepository $userRepository, EvenementService $evenementService): JsonResponse
    {
        $user = $userRepository->findUserById($userId);

        if (!$user) {
            return $this->json(['status' => 'error', 'message' => 'Aucun événement trouvé pour cet utilisateur'], 404);
        }

        $evenements= $user->getEvenements();

        $convert = new EvenementMinDtoConverter($evenementService);
        $dtoList = [];

        foreach ($evenements as $evenement) {
            if ($evenement) {
                array_push($dtoList, $convert->convertToDto($evenement));
            }
        }

        return $this->json($dtoList, 200, [], ['json_encode_options' => JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES]);
    }

     
}
