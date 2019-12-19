<?php
declare(strict_types=1);

namespace App\Entity\Intent;

use App\Entity\AlexaResponse;

class AmazonCancelIntent implements IntentInterface
{
    public const TYPE = 'AMAZON.CancelIntent';

    public function canHandle(String $intentType): bool
    {
        return $intentType === self::TYPE;
    }

    public function execute(array $request): AlexaResponse
    {
        return new AlexaResponse(
            'Hasta la próxima y que los dioses del metal de acompañen.',
            true
        );
    }
}
