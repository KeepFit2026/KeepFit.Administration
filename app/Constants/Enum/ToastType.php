<?php

namespace App\Constants\Enum;

enum ToastType: string
{
    case SUCCESS = 'success';
    case ERROR   = 'error';
    case WARNING = 'warning';
    case INFO    = 'info';

    public function title(): string
    {
        return match($this) {
            self::SUCCESS => 'Succès',
            self::ERROR   => 'Erreur',
            self::WARNING => 'Attention',
            self::INFO    => 'Information',
        };
    }

    public function icon(): string
    {
        return match($this) {
            self::SUCCESS => 'bi-check-circle-fill',
            self::ERROR   => 'bi-exclamation-triangle-fill',
            self::WARNING => 'bi-exclamation-circle-fill',
            self::INFO    => 'bi-info-circle-fill',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::SUCCESS => 'success',
            self::ERROR   => 'danger',
            self::WARNING => 'warning',
            self::INFO    => 'info',
        };
    }
}