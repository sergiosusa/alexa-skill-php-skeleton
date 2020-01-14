<?php
declare(strict_types=1);

namespace App\Tests\Service;

use App\Entity\Joke;
use App\Exception\AlexaRequestNotSupportedException;
use App\Exception\IntentNotSupportedException;
use App\Repository\InMemoryJokeRepository;
use App\Service\AlexaRequestManager;
use App\Service\Intent\JokeIntent;
use App\Service\IntentManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class IntentManagerTest extends KernelTestCase
{

    /** @var InMemoryJokeRepository */
    private $jokeRepository;

    /** @var IntentManager */
    private $intentManager;

    protected function setUp(): void
    {
        $this->jokeRepository = $this->createMock(InMemoryJokeRepository::class);
        $this->jokeRepository->method('getRandomJoke')
            ->willReturn(new Joke('this is a bad joke!'));

        $this->intentManager = new IntentManager(
            [
                new JokeIntent($this->jokeRepository),
            ]
        );
    }

    public function testChooseACorrectIntent(): void
    {
        $alexaResponse = $this->intentManager->execute(JokeIntent::TYPE, []);

        self::assertContains('this is a bad joke!', $alexaResponse->text());
        self::assertTrue($alexaResponse->shouldEndSession());
    }

    public function testThrowAnExceptionOnANonExistIntent(): void
    {
        $this->expectException(IntentNotSupportedException::class);
        $this->intentManager->execute('FakeIntent', []);
    }

}
