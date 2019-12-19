<?php
declare(strict_types=1);

namespace App\Controller;

use App\Exception\AlexaRequestNotSupportedException;
use App\Exception\SessionEndedException;
use App\Service\AlexaRequestManager;
use MaxBeckers\AmazonAlexa\Exception\MissingRequestDataException;
use MaxBeckers\AmazonAlexa\Exception\MissingRequiredHeaderException;
use MaxBeckers\AmazonAlexa\Exception\OutdatedCertExceptionException;
use MaxBeckers\AmazonAlexa\Exception\RequestInvalidSignatureException;
use MaxBeckers\AmazonAlexa\Exception\RequestInvalidTimestampException;
use MaxBeckers\AmazonAlexa\Validation\RequestValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use MaxBeckers\AmazonAlexa\Request\Request as AmazonRequestValidator;

class AlexaController extends AbstractController
{
    /** @var String */
    private $applicationId;
    /** @var AlexaRequestManager */
    private $alexaRequestManager;

    public function __construct(String $applicationId, AlexaRequestManager $alexaRequestManager)
    {
        $this->applicationId = $applicationId;
        $this->alexaRequestManager = $alexaRequestManager;
    }

    public function ping(): Response
    {
        return new Response('pong');
    }

    public function intent(Request $request): Response
    {
        try {

            $data = json_decode($request->getContent(), true);

            if ($data['session']['application']['applicationId'] !== $this->applicationId) {
                return new Response('', Response::HTTP_BAD_REQUEST);
            }

            $validator = new RequestValidator();
            $alexaRequest = AmazonRequestValidator::fromAmazonRequest(
                $request->getContent(),
                $request->server->get('HTTP_SIGNATURECERTCHAINURL'),
                $request->server->get('HTTP_SIGNATURE')
            );
            $validator->validate($alexaRequest);
            $alexaResponse = $this->alexaRequestManager->execute($data['request']['type'], $data['request']);

            $this->render(
                'response.' . $request->attributes->get('_format') . '.twig',
                [
                    'text' => $alexaResponse->text(),
                    'shouldEndSession' => $alexaResponse->shouldEndSession(),
                ]
            );

        } catch (
        OutdatedCertExceptionException | RequestInvalidSignatureException |
        RequestInvalidTimestampException | MissingRequestDataException |
        MissingRequiredHeaderException | AlexaRequestNotSupportedException $e) {
            return new Response('', Response::HTTP_BAD_REQUEST);
        } catch (SessionEndedException $exception) {
            return new Response(null);
        }

    }
}
