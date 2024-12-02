<?php

namespace App\Enums;

enum UserRole: string
{
    case TEACHER = 'teacher';
    case STUDENT = 'student';
}
