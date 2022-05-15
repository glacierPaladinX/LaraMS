<?php

namespace App\Http\Controllers\learn;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Sessionable;
use App\Models\Term;
use App\Models\Workout;
use App\Utility\Modules\Tasks\TaskFactory;
use App\Utility\Question\QuestionFactory;
use App\Utility\Workout\WorkoutService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkoutController extends Controller
{


    public function prepared(Term $term, Sessionable $sessionable)
    {

        WorkoutService::WorkOutSyncForThisExcersice($term, $sessionable, Auth::user());

        return redirect(route('taskLearner', ['term' => $term, 'sessionable' => $sessionable]));
    }

    public function task(Term $term, Sessionable $sessionable)
    {

        $className = $sessionable->sessionable_type;

        $task = TaskFactory::Build($className);
        $task->set_user(Auth::user());
        return $task->Render($term, $sessionable);
    }

    public function completedAndNext(Workout $workout)
    {
        if ($workout->is_completed == 0)
            $workout->Completed();

        return redirect()->back();
    }


    public function workout(Request $request)
    {

        $request->validate([
            'question_id' => 'required|int',
            'workout_id' => 'required|int'
        ]);


        $question = Question::findorfail($request->question_id);
        $workout = Workout::findorfail($request->workout_id);

        return QuestionFactory::Build($question->questionType)
            ->workoutChecker($question, $workout, $request);
    }
}
