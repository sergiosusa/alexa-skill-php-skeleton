<?php
declare(strict_types=1);

namespace App\Service\Request;

use App\Exception\SessionEndedException;

class SessionEndedRequest implements AlexaRequestInterface
{
    public const TYPE = 'SessionEndedRequest';

    public function canHandle(String $requestType): bool
    {
        return self::TYPE === $requestType;
    }

    public function execute(array $request)
    {
        throw new SessionEndedException();
    }
}
