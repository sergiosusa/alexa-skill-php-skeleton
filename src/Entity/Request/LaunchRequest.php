<?php
declare(strict_types=1);

namespace App\Entity\Request;

use App\Entity\AlexaResponse;

class LaunchRequest implements AlexaRequestInterface
{
    public const TYPE = 'LaunchRequest';

    public function canHandle(String $requestType): bool
    {
        return self::TYPE === $requestType;
    }

    public function execute(array $request)
    {
        new AlexaResponse(
            'Bienvenido mortal, deja que mi infinita sabiduría te guíe por los caminos del metal. Qué quieres saber?',
            false
        );
    }
}
