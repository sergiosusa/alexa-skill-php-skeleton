<?php
declare(strict_types=1);

namespace App\Tests\Service;

use App\Entity\AlexaResponse;
use App\Exception\AlexaRequestNotSupportedException;
use App\Service\AlexaRequestManager;
use App\Service\Intent\AmazonCancelIntent;
use App\Service\Intent\AmazonHelpIntent;
use App\Service\Intent\AmazonStopIntent;
use App\Service\Intent\JokeIntent;
use App\Service\Request\IntentRequest;
use Generator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AlexaRequestManagerTest extends KernelTestCase
{
    /** @var AlexaRequestManager */
    private $alexaRequestManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->alexaRequestManager = $kernel->getContainer()
            ->get(AlexaRequestManager::class);
    }

    public function intentsToTest(): Generator
    {
        yield 'joke intent' => [
            IntentRequest::TYPE,
            [
                'intent' => [
                    'name' => JokeIntent::TYPE,
                    [],
                ],
            ],
            'joke',
            true,
        ];

        yield 'stop intent' => [
            IntentRequest::TYPE,
            [
                'intent' => [
                    'name' => AmazonStopIntent::TYPE,
                    [],
                ],
            ],
            'Stop intent.',
            true,
        ];

        yield 'cancel intent' => [
            IntentRequest::TYPE,
            [
                'intent' => [
                    'name' => AmazonCancelIntent::TYPE,
                    [],
                ],
            ],
            'Cancel intent',
            true,
        ];


        yield 'help intent' => [
            IntentRequest::TYPE,
            [
                'intent' => [
                    'name' => AmazonHelpIntent::TYPE,
                    [],
                ],
            ],
            'Help intent',
            false,
        ];
    }

    /** @dataProvider intentsToTest */
    public function testIntentsReturnValidAnswers(
        String $requestType,
        array $request,
        String $responseText,
        bool $shouldEndSession
    ): void {
        /** @var AlexaResponse $response */
        $response = $this->alexaRequestManager->execute(
            $requestType,
            $request
        );
        self::assertContains($responseText, $response->text());
        self::assertEquals($shouldEndSession, $response->shouldEndSession());
    }

    public function testNotSupportedException(): void
    {
        $this->expectException(AlexaRequestNotSupportedException::class);
        $this->alexaRequestManager->execute(
            'FakeRequest',
            []
        );
    }
}
