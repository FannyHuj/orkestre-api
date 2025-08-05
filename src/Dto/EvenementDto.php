<?php

namespace App\Dto;

use App\Entity\EvenementCategoryEnum;

Class EvenementDto {

    private ?int $id = null;
    private ?string $title = null;
    private ?string $description = null;
    private ?\DateTimeInterface $evenementDate = null;
    private ?string $location = null;
    private ?int $maxCapacity = null;
    private ?int $price = null;
    private ?EvenementCategoryEnum $category = null;
    private ?UserDto $organizer = null;
    private ?int $countParticipants = null;
    private ?int $remainingCapacity = null;


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
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of evenementDate
     */ 
    public function getEvenementDate()
    {
        return $this->evenementDate;
    }

    /**
     * Set the value of evenementDate
     *
     * @return  self
     */ 
    public function setEvenementDate($evenementDate)
    {
        $this->evenementDate = $evenementDate;

        return $this;
    }

    /**
     * Get the value of location
     */ 
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set the value of location
     *
     * @return  self
     */ 
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get the value of maxCapacity
     */ 
    public function getMaxCapacity()
    {
        return $this->maxCapacity;
    }

    /**
     * Set the value of maxCapacity
     *
     * @return  self
     */ 
    public function setMaxCapacity($maxCapacity)
    {
        $this->maxCapacity = $maxCapacity;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of category
     */ 
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set the value of category
     *
     * @return  self
     */ 
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }


    /**
     * Get the value of organizer
     */ 
    public function getOrganizer()
    {
        return $this->organizer;
    }

    /**
     * Set the value of organizer
     *
     * @return  self
     */ 
    public function setOrganizer($organizer)
    {
        $this->organizer = $organizer;

        return $this;
    }

    /**
     * Get the value of countParticipants
     */ 
    public function getCountParticipants()
    {
        return $this->countParticipants;
    }

    /**
     * Set the value of countParticipants
     *
     * @return  self
     */ 
    public function setCountParticipants($countParticipants)
    {
        $this->countParticipants = $countParticipants;

        return $this;
    }

    /**
     * Get the value of remainingCapacity
     */ 
    public function getRemainingCapacity()
    {
        return $this->remainingCapacity;
    }

    /**
     * Set the value of remainingCapacity
     *
     * @return  self
     */ 
    public function setRemainingCapacity($remainingCapacity)
    {
        $this->remainingCapacity = $remainingCapacity;

        return $this;
    }

}