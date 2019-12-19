<?php
declare(strict_types=1);

namespace App\Entity\Intent;

use App\Entity\AlexaResponse;

interface IntentInterface
{
    public function canHandle(String $requestType): bool;
    public function execute(array $request): AlexaResponse;
}
