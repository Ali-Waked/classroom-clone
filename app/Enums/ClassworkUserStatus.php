<?php

namespace App\Enums;

enum ClassworkUserStatus: string
{
    case ASSIGNED =  'assigned';
    case DRAFT = 'draft';
    case SUBMITTED = 'submitted';
    case RETURNED = 'returned';
    case EVALUATED = 'evaluated';
}
