<?php

namespace App;

enum UserRole: string
{
    case Administrator = 'administrator';
    case Verifikator = 'verifikator';
    case Administrative = 'administrative';
    case User = 'user';

    public function label(): string
    {
        return match ($this) {
            self::Administrator => 'Administrator',
            self::Verifikator => 'Verifikator',
            self::Administrative => 'Administrative',
            self::User => 'User',
        };
    }
}
