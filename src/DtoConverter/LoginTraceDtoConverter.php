<?php

namespace App\DtoConverter;
use App\Dto\LoginTraceDto;

class LoginTraceDtoConverter {

    public function convertToDto(array $loginTraceData): LoginTraceDto {
        $loginTraceDto = new LoginTraceDto();
        $loginTraceDto->setId($loginTraceData['id'] ?? null);
        $loginTraceDto->setEmail($loginTraceData['email'] ?? null);
        $loginTraceDto->setLoginDate(new \DateTime($loginTraceData['loginDate'] ?? 'now'));
        $loginTraceDto->setUserId($loginTraceData['userId'] ?? null);

        return $loginTraceDto;
    }

    public function convertToEntity(LoginTraceDto $loginTraceDto): array {
        return [
            'id' => $loginTraceDto->getId(),
            'email' => $loginTraceDto->getEmail(),
            'loginDate' => $loginTraceDto->getLoginDate()->format('Y-m-d H:i:s'),
            'userId' => $loginTraceDto->getUserId(),
        ];
    }
}