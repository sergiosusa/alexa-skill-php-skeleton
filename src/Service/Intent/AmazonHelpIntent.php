<?php
declare(strict_types=1);

namespace App\Service\Intent;

use App\Entity\AlexaResponse;

class AmazonHelpIntent implements IntentInterface
{
    public const TYPE = 'AMAZON.HelpIntent';

    public function canHandle(String $intentType): bool
    {
        return $intentType === self::TYPE;
    }

    public function execute(array $request): AlexaResponse
    {
        return new AlexaResponse(
            'Help intent.',
            false
        );
    }
}
