<?php
declare(strict_types=1);

namespace App\Repository;


use App\Exceptions\QuestionAlreadyExistException;
use App\Models\Question;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use stdClass;

class QuestionRepository implements IQuestionRepository
{
    private const TABLE_NAME = 'questions';

    public function insert(Question $question): bool
    {
        $existentQuestion = $this->byText($question->getText());
        if (is_null($existentQuestion))
            return $question->saveOrFail();

        throw new QuestionAlreadyExistException($existentQuestion->getId());
    }

    public function all(): array
    {
        $questionsRaw = DB::table(self::TABLE_NAME)
            ->orderByDesc('created_at')
            ->get()
            ->toArray();

        return Question::hydrate($questionsRaw)->all();
    }

    public function find(int $id, bool $eagerLoad = false): ?Question
    {
        $question = self::mapInstance(
            DB::table(self::TABLE_NAME)
                ->find($id));

        if (is_null($question))
            return null;

        if ($eagerLoad) {
            $question->load(['answers']);
            $question->setAmountOfAnswers($question->answers()->count());
        }

        return $question;
    }

    private function byText(string $text): ?Question
    {
        $questionRaw = DB::table(self::TABLE_NAME)
            ->where('text', $text)
            ->limit(1)
            ->first();

        return self::mapInstance($questionRaw);
    }

    private static function mapInstance(?stdClass $questionRaw): ?Question
    {
        return !is_null($questionRaw) ?
            new Question(get_object_vars($questionRaw)) :
            null;
    }
}
