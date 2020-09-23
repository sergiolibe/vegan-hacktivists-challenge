<?php
declare(strict_types=1);

namespace App\Service;


use App\Models\Answer;
use App\Models\Question;
use App\Repository\IAnswerRepository;

class AnswerService
{
    private IAnswerRepository $answerRepository;

    public function __construct(IAnswerRepository $answerRepository)
    {
        $this->answerRepository = $answerRepository;
    }
}
