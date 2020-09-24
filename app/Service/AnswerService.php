<?php
declare(strict_types=1);

namespace App\Service;


use App\Models\Answer;
use App\Models\Question;
use App\Repository\IAnswerRepository;
use Throwable;

class AnswerService
{
    private IAnswerRepository $answerRepository;

    public function __construct(IAnswerRepository $answerRepository)
    {
        $this->answerRepository = $answerRepository;
    }

     /**
     * @param Answer $answer
     * @return bool
     * @throws Throwable
     */
    public function insert(Answer $answer): bool
    {
        return $this->answerRepository->insert($answer);
    }
}
