<?php
declare(strict_types=1);

namespace App\Service\Intent;

use App\Entity\AlexaResponse;

interface IntentInterface
{
    public function canHandle(String $intentType): bool;
    public function execute(array $request): AlexaResponse;
}
