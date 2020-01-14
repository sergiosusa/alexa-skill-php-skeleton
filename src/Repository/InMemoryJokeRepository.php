<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Joke;

class InMemoryJokeRepository implements JokeRepository
{
    public function getRandomJoke(): Joke
    {
        $jokes = [
            new Joke('joke 1'),
            new Joke('joke 2'),
            new Joke('joke 3'),
        ];

        $numMessage = random_int(0, count($jokes) - 1);

        return $jokes[$numMessage];
    }
}
