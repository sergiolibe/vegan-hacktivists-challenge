<?php
declare(strict_types=1);

namespace App\Repository;


use App\Models\Answer;

class AnswerRepository implements IAnswerRepository
{
    public function insert(Answer $answer): bool
    {
        return $answer->saveOrFail();
    }

    public function amountByQuestionId(int $questionId): int
    {
        return Answer::where('question_id', $questionId)->count();
    }
}
