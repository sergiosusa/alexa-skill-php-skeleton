<?php
declare(strict_types=1);

namespace App\Service\Intent;

use App\Entity\AlexaResponse;
use App\Repository\JokeRepository;

class JokeIntent implements IntentInterface
{
    public const TYPE = 'SKILL.JokeIntent';

    /** @var JokeRepository */
    private $jokeRepository;

    public function __construct(JokeRepository $jokeRepository)
    {
        $this->jokeRepository = $jokeRepository;
    }

    public function canHandle(String $intentType): bool
    {
        return $intentType === self::TYPE;
    }

    public function execute(array $request): AlexaResponse
    {
        $joke = $this->jokeRepository->getRandomJoke();

        return new AlexaResponse(
            $joke->text(),
            true
        );
    }
}
