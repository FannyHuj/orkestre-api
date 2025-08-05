<?php

namespace App\Dto;

use App\Entity\EvenementCategoryEnum;

Class LoginTraceDto {
    private ?string $id = null;
    private ?string $email = null;
    private ?\DateTimeInterface $loginDate = null;
    private ?string $userId = null;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }



    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of loginDate
     */ 
    public function getLoginDate()
    {
        return $this->loginDate;
    }

    /**
     * Set the value of loginDate
     *
     * @return  self
     */ 
    public function setLoginDate($loginDate)
    {
        $this->loginDate = $loginDate;

        return $this;
    }

    /**
     * Get the value of userId
     */ 
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of userId
     *
     * @return  self
     */ 
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }
}