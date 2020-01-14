<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\AlexaResponse;
use App\Exception\AlexaRequestNotSupportedException;
use App\Service\Request\AlexaRequestInterface;

class AlexaRequestManager
{

    /** @var AlexaRequestInterface[] */
    private $requests;

    public function __construct(array $requests)
    {
        $this->requests = $requests;
    }

    /** @throws AlexaRequestNotSupportedException */
    public function execute(String $requestType, array $request): AlexaResponse
    {
        $alexaRequest = $this->findAlexaRequest($requestType);

        return $alexaRequest->execute($request);
    }

    /** @throws AlexaRequestNotSupportedException */
    private function findAlexaRequest(String $requestType): AlexaRequestInterface
    {
        foreach ($this->requests as $request) {
            if ($request->canHandle($requestType)) {
                return $request;
            }
        }
        throw new AlexaRequestNotSupportedException($requestType);
    }
}
