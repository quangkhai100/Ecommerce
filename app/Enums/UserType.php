<?php

namespace App\Enums;
use BenSampo\Enum\Enum;


final class UserType extends Enum
{
    const ADMINISTRATOR = 1;
    const MEMBER = 0;
}
