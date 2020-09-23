<?php
declare(strict_types=1);

namespace App\Factory;


class QuestionFactory
{
    private static array $questions = [
        'why vegans dont eat backyard eggs?',
        'why vegans dont consume honey?',
        'why there are some vegans products labeled as soy-free?',
        'can I replace the animal protein in my diet?',
        'how can a start a vegan lifestyle?',
    ];

    public static function generateQuestion(): string
    {
        $len = count(self::$questions);
        return self::$questions[rand(0, $len - 1)];
    }
}
