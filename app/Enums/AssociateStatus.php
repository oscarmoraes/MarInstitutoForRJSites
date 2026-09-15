<?php

namespace App\Enums;

enum AssociateStatus: string
{
    case Pending = 'pending';
    case Active = 'active';
    case Inactive = 'inactive';
    case Blocked = 'blocked';

    /**
     * Get the label for the status
     */
    public function label(): string
    {
        return match($this) {
            self::Pending => 'Pendente',
            self::Active => 'Ativo',
            self::Inactive => 'Inativo',
            self::Blocked => 'Bloqueado',
        };
    }

    /**
     * Get the color badge for display
     */
    public function color(): string
    {
        return match($this) {
            self::Pending => 'warning',
            self::Active => 'success',
            self::Inactive => 'gray',
            self::Blocked => 'danger',
        };
    }

    /**
     * Get all available statuses
     */
    public static function all(): array
    {
        return [
            self::Pending->value,
            self::Active->value,
            self::Inactive->value,
            self::Blocked->value,
        ];
    }
}
