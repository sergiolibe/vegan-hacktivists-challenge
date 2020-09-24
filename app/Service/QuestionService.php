<?php
declare(strict_types=1);

namespace App\Service;


use App\Factory\QuestionFactory;
use App\Models\Question;
use App\Repository\IAnswerRepository;
use App\Repository\IQuestionRepository;
use Exception;
use Throwable;

class QuestionService
{
    private IAnswerRepository $answerRepository;
    private IQuestionRepository $questionRepository;

    public function __construct(IAnswerRepository $answerRepository, IQuestionRepository $questionRepository)
    {
        $this->answerRepository = $answerRepository;
        $this->questionRepository = $questionRepository;
    }

    /**
     * @param Question $question
     * @return bool
     * @throws Throwable
     */
    public function insert(Question $question): bool
    {
        if( substr($question->getText(),-1) !== '?')
            throw new Exception('Your question must end with a \'?\'');

        return $this->questionRepository->insert($question);
    }

    public function findById(int $id): ?Question
    {
        return $this->questionRepository->find($id, true);
    }

    /** @return Question[] */
    public function getAll(): array
    {
        $questions = $this->questionRepository->all();
        foreach ($questions as $question)
            $this->fillAmountOfAnswers($question);

        return $questions;
    }

    private function fillAmountOfAnswers(Question $question): void
    {
        $amountOfAnswers = $this->answerRepository->amountByQuestionId($question->getId());
        $question->setAmountOfAnswers($amountOfAnswers);
    }

    public function getRandomQuestion(): string
    {
        return QuestionFactory::generateQuestion();
    }
}
