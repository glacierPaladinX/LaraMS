<?php

namespace App\Utility\Modules\Tasks\Adabpter;

use App\Models\Sessionable;
use App\Models\Term;
use App\Models\Workout;
use App\Utility\Modules\Tasks\Services\TaskParent;
use App\Utility\Workout\WorkoutService;

class DocumentAdapter extends TaskParent
{
    protected string $view = 'contents.learn.documents.show';
    public bool $is_mentor = false;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function Render(Term $term, Sessionable $sessionable)
    {
        
        $workout = WorkoutService::WorkOutSyncForThisExcersice($term, $sessionable, $this->user);
        
        $activity = $sessionable->Model;

        $review = $this->Review($term, $workout);

        return view($this->view, compact([
            'activity', 'workout', 'term', 'review'
        ]));
    }

    
    public function Review(Term $term, Workout $workout): bool
    {
        if($workout->is_completed == 1){
            return true;
        }

        return false;
    }

    public function Mentor(): void
    {
        $this->is_mentor = true;
    }
}
