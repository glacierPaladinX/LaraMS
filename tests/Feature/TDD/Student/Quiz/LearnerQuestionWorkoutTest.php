<?php

namespace Tests\Feature\TDD\Student\Quiz;

use App\Models\Sessionable;
use App\Models\Workout;
use App\Models\WorkoutQuizLog;
use Tests\BaseTest;

class LearnerQuestionWorkoutTest extends BaseTest
{

    private $student_id = 8;
    private $term = 1;
    private $sessionable = 16;


    public function student()
    {
        $this->signIn($this->student_id);
    }

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
    public function test_quiz_testing_questions_render()
    {
        $this->student();
        $response = $this->get(route('taskLearner', [
            'term' => $this->term,
            'sessionable' => $this->sessionable
        ]));
       

        $response->assertStatus(200);
    }


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_quiz_with_test()
    {
        $this->withoutExceptionHandling();

        $this->test_quiz_testing_questions_render();

        $value = [
            'question_id' => 1,
            'workout_id' => 1,
            'answer' => 1
        ];
        $this->postRequestCheckCorrectAndExist($value);

        $value = [
            'question_id' => 2,
            'workout_id' => 1,
            'answer' => 0
        ];
        $this->postRequestCheckCorrectAndExist($value);

        $value = [
            'question_id' => 3,
            'workout_id' => 1,
            'answer' => 1
        ];
        $this->postRequestCheckCorrectAndExist($value);
    }

    private function postRequestCheckCorrectAndExist($value)
    {
        $response = $this->post(route(
            'quizWorkout',
            [
                'question_id' => $value['question_id'],
                'workout_id' => $value['workout_id'],
                'answer-' . $value['question_id'] => $value['answer']
            ]
        ));
        
        $response->assertStatus(200);

        $this->assertDatabaseHas(WorkoutQuizLog::class, [
            'question_id' => $value['question_id'],
            'answer' => $value['answer'],
            'is_mentor' => 0,
            'workout_id' => $value['workout_id'],
            'score' => 100
        ]);
    }
}
