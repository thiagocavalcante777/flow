<?php

/**
 * Class StatusTimeTaskEnum
 * @package App\Domain\Enum
 */


namespace App\Domain\Enum;


abstract class StatusTimeTaskEnum
{
    const OPENED = 'O';
    const CLOSE = 'C';
    const ABORTED = 'A';
    const SYNCHRONIZED = 'S';

    private const STATUS = [
        self::OPENED => 'ABERTO/EM ANDAMENTO',
        self::CLOSE => 'FECHADO',
        self::ABORTED => 'ABORTADA/CANCELADA',
        self::SYNCHRONIZED => 'SINCRONIZADO'
    ];

    public static function getDescriptionByChar($char = null)
    {
        if ($char == null) {
            return self::STATUS['O'];
        }
        return self::STATUS[$char];
    }
}


