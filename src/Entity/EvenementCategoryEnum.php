<?php

namespace App\Entity;

enum EvenementCategoryEnum: string {

    case CONCERT = 'concert';
    case CONFERENCE = 'conference';
    case SPORT = 'sport';
    case CULTURE = 'culture';
    case CULINARY = 'culinary';
}