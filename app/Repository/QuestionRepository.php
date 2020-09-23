<?php
declare(strict_types=1);

namespace App\Repository;


use App\Models\Question;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class QuestionRepository implements IQuestionRepository
{
    private const TABLE_NAME = 'questions';

    public function insert(Question $question): bool
    {
        $existentQuestion = $this->byText($question->getText());
        if (is_null($existentQuestion))
            return $question->saveOrFail();

        throw new Exception('Question already exist: ' . $existentQuestion->getId());
    }

    public function all(): array
    {
        $questionsRaw = DB::table(self::TABLE_NAME)
            ->orderByDesc('created_at')
            ->get()
            ->toArray();

        return Question::hydrate($questionsRaw)->all();
    }

    private function byText(string $text): ?Question
    {
        $questionRaw = DB::table(self::TABLE_NAME)
            ->where('text', $text)
            ->limit(1)
            ->first();

        return !is_null($questionRaw)?
            new Question(get_object_vars($questionRaw)) :
            null;
    }
}
