<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Service\AnswerService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Throwable;

class AnswerController extends Controller
{

    private AnswerService $answerService;

    /**
     * AnswerController constructor.
     * @param AnswerService $answerService
     */
    public function __construct(AnswerService $answerService)
    {
        $this->answerService = $answerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param int|string $questionId
     * @param Request $request
     * @return RedirectResponse
     */
    public function store($questionId, Request $request)
    {
        if (!is_numeric($questionId))
            return redirect()->route('home');

        $request->validate([
            'text' => 'required|min:5',
        ]);

        $answer = new Answer([
            'question_id' => $questionId,
            'text' => $request->get('text')
        ]);

        try {
            $success = $this->answerService->insert($answer);

            return $success ?
                redirect()->route('question.show', [$answer->getQuestionId()]) :
                back()
                    ->withInput(['text' => $request->get('text')])
                    ->withErrors(['Your answer wasn\'t submitted']);
        } catch (Throwable $e) {
            return back()
                ->withInput(['text' => $request->get('text')])
                ->withErrors([$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Answer $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Answer $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param \App\Models\Answer $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Answer $answer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Answer $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        //
    }
}
