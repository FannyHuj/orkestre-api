<?php

namespace App\Entity;

enum UserRoleEnum: string {

    case USER = 'user';
    case ORGANIZER = 'organizer';
    case ADMIN = 'admin';

}