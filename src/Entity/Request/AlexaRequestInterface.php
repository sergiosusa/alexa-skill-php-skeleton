<?php
declare(strict_types=1);

namespace App\Entity\Request;

interface AlexaRequestInterface
{
    public function canHandle(String $requestType): bool;
    public function execute(array $request);
}
