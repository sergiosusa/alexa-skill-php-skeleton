<?php
declare(strict_types=1);

namespace App\Entity\Intent;

use App\Entity\AlexaResponse;

class AmazonStopIntent implements IntentInterface
{
    public const TYPE = 'AMAZON.StopIntent';

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
