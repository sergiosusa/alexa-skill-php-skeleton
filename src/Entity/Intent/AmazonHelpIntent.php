<?php
declare(strict_types=1);

namespace App\Entity\Intent;

use App\Entity\AlexaResponse;

class AmazonHelpIntent implements IntentInterface
{
    private const TYPE = 'AMAZON.HelpIntent';

    public function canHandle(String $intentType): bool
    {
        return $intentType === self::TYPE;
    }

    public function execute(array $request): AlexaResponse
    {
        return new AlexaResponse(
            'Al dios de metal le puedes preguntar: ¿cuáles son los próximos conciertos en barcelona? o ¿qué conciertos hay en barcelona?.',
            false
        );
    }
}
