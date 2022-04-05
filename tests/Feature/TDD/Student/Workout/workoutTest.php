<?php

namespace Tests\Feature\TDD\Student\Workout;

use App\Models\Workout;
use Tests\BaseTest;

class workoutTest extends BaseTest
{

    private $workout = 'App\Models\Workout';
    private $workoutQuiz = 'App\Models\WorkoutQuizLog';

    protected function setUp(): void
    {

        parent::setUp();
        $this->seed();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_first_term_is_exist()
    {
        $this->signIn(8);
        $response = $this->get(route('learningCourse', ['term' => 1]));

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_first_view_set_record()
    {
        $this->signIn(8);
        $response = $this->get(route('fileLearner', [
            'term' => 1,
            'activity' => 1,
            'session' => 1,
            'sessionable' => 1
        ]));

        $response->assertStatus(200);

        $this->assertDatabaseHas(
            $this->workout,
            [
                'user_id' => "8",
                'term_id' => "1",
                'activity_id' => "1",
                'session_id' => "1",
                'sessionable_id' => "1",
                'is_completed' => "0"
            ]
        );
    }



    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_first_view_quiz_set_record()
    {
        $this->signIn(8);
        $response = $this->get(route('quizLearner', [
            'term' => 1,
            'activity' => 2,
            'session' => 1,
            'sessionable' => 16
        ]));

        $response->assertStatus(200);
        
        $workout = Workout::where([
            'user_id' => "8",
            'term_id' => "1",
            'activity_id' => "2",
            'session_id' => "1",
            'sessionable_id' => "16",
            'is_completed' => "0"
        ])->first();

        $this->assertModelExists(
            $workout
        );


        $this->assertDatabaseHas(
            $this->workoutQuiz,
            [
                'workout_id' => $workout->id,
                'quiz_id' => $workout->activity_id,
            ]
        );
    }
}
