<?php
declare(strict_types=1);

namespace App\Entity\Request;

use App\Service\IntentManager;

class IntentRequest implements AlexaRequestInterface
{
    public const TYPE = 'IntentRequest';

    /** @var IntentManager */
    private $intentManager;

    public function __construct(IntentManager $intentManager)
    {
        $this->intentManager = $intentManager;
    }

    public function canHandle(String $requestType): bool
    {
        return self::TYPE === $requestType;
    }

    public function execute(array $request)
    {
        return $this->intentManager->execute($request["intent"]['name'], $request);
    }
}
