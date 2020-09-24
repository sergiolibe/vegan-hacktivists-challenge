<?php
declare(strict_types=1);

namespace App\Repository;


use App\Models\Question;
use Throwable;

interface IQuestionRepository
{
    /**
     * @param Question $question
     * @return bool
     * @throws Throwable
     */
    public function insert(Question $question): bool;

    /** @return Question[] */
    public function all(): array;

    public function find(int $id, bool $eagerLoad = false): ?Question;
}
