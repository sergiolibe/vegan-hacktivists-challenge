<?php
declare(strict_types=1);

namespace App\Exceptions;


use RuntimeException;

class QuestionAlreadyExistException extends RuntimeException
{
    private int $questionId;

    /**
     * QuestionAlreadyExistException constructor.
     * @param int $questionId
     */
    public function __construct(int $questionId)
    {
        parent::__construct('Question already exist');
        $this->questionId = $questionId;
    }

    /**
     * @return int
     */
    public function getQuestionId(): int
    {
        return $this->questionId;
    }
}
