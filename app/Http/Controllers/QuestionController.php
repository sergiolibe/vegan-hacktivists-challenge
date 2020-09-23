<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Service\QuestionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Throwable;

class QuestionController extends Controller
{

    private QuestionService $questionService;

    /**
     * QuestionController constructor.
     * @param QuestionService $questionService
     */
    public function __construct(QuestionService $questionService)
    {
        $this->questionService = $questionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response|View
     */
    public function index()
    {
        $questions = $this->questionService->getAll();
        $randomQuestion = $this->questionService->getRandomQuestion();
        return view('question.index',
            [
                'questions' => $questions,
                'randomQuestion' => $randomQuestion,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response|RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required|min:5'
        ]);

        $question = new Question($request->all());

        try {
            $success = $this->questionService->insert($question);

            return $success ?
                redirect()->route('home') :
                back()->withErrors(['Your question wasn\'t sumitted']);

        } catch (Throwable $e) {
            return back()->withErrors([$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Question $question
     * @return Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Question $question
     * @return Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param \App\Models\Question $question
     * @return Response
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Question $question
     * @return Response
     */
    public function destroy(Question $question)
    {
        //
    }
}
