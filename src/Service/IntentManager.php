<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\AlexaResponse;
use App\Exception\IntentNotSupportedException;
use App\Service\Intent\IntentInterface;

class IntentManager
{

    /** @var IntentInterface[] */
    private $intents;

    public function __construct(array $intents)
    {
        $this->intents = $intents;
    }

    /** @throws IntentNotSupportedException */
    public function execute(String $intentType, array $request): AlexaResponse
    {
        $intent = $this->findIntent($intentType);
        return $intent->execute($request);
    }

    /** @throws IntentNotSupportedException */
    private function findIntent(String $intentType)
    {
        foreach ($this->intents as $intent)
        {
            if ($intent->canHandle($intentType)){
                return $intent;
            }
        }

        throw new IntentNotSupportedException($intentType);

    }

}
