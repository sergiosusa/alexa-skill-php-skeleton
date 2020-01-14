<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Joke;

interface JokeRepository
{
    public function getRandomJoke(): Joke;
}
