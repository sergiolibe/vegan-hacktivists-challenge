<?php
declare(strict_types=1);

namespace App\Repository;


use App\Models\Answer;
use Throwable;

interface IAnswerRepository
{

    /**
     * @param Answer $answer
     * @return bool
     * @throws Throwable
     */
    public function insert(Answer $answer): bool;

    public function amountByQuestionId(int $questionId): int;
}
