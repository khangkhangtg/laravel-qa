<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;

class AcceptAnswerController extends Controller
{
    public function __invoke(Answer $answer)
    {
        $this->authorize('accept', $answer);
        // dd('Answer accepted.');
        $answer->question->acceptBestAnswer($answer);
        return redirect()->back();
    }
}
