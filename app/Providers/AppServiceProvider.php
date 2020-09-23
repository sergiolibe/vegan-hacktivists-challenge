<?php

namespace App\Providers;

use App\Repository\AnswerRepository;
use App\Repository\IAnswerRepository;
use App\Repository\IQuestionRepository;
use App\Repository\QuestionRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /** All of the container bindings that should be registered. */
    public array $bindings = [
        IAnswerRepository::class => AnswerRepository::class,
        IQuestionRepository::class => QuestionRepository::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
