<?php
declare(strict_types=1);

namespace App\Service;


use App\Models\Question;
use App\Repository\IAnswerRepository;
use App\Repository\IQuestionRepository;
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
        $this->questionRepository->insert($question);
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
}
