<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\TempCorrectAnswer;
use App\Services\QuizApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{

    public function __construct(protected QuizApiService $quizApi) {}

    public function fetchQuiz()
    {
        $data = $this->quizApi->getQuizData();

        if ($data) {
            foreach ($data as $quizData) {
                // Create the quiz entry
                $quiz = Quiz::create([
                    'title' => $quizData['category'],
                ]);

                // Create the question entry
                $question = Question::create([
                    'quiz_id' => $quiz->id, // Ensure question is associated with the quiz
                    'question_text' => $quizData['question'],
                ]);

                // Create the answer entry, ensuring that the question_id and answer_id are the same
                Answer::create([
                    'question_id' => $question->id,
                    'answer_text' => $quizData['correctAnswer'],
                    'is_correct' => true, // Assuming this is the correct answer
                ]);

                // Optionally, handle other answer choices if present
                // For example:
                foreach ($quizData['incorrectAnswers'] as $incorrectAnswer) {
                    Answer::create([
                        'question_id' => $question->id,
                        'answer_text' => $incorrectAnswer,
                        'is_correct' => false,
                    ]);
                }
            }

            return response()->json(['message' => 'Quiz data imported successfully.'], 200);
        } else {
            return response()->json(['message' => 'Failed to fetch quiz data.'], 500);
        }
    }
   
    public function Quiz()
    {
        // Fetch 4 random questions with their answers
        $questions = Question::with('answers')->inRandomOrder()->limit(4)->get();
    
        // Instead of storing correct answers, just pass the questions to the view
        $data = compact('questions');
        return view('quiz')->with($data);
    }
    
    
   public function submitQuiz(Request $request)
{
    $validatedData = $request->validate([
        'op1' => 'required|string',
        'op2' => 'required|string',
        'op3' => 'required|string',
        'op4' => 'required|string',
    ]);

    foreach ($validatedData as $key => $answer) {
        $questionId = (int)substr($key, 4); // Extract the question number from the name
        TempCorrectAnswer::create([
            'question_id' => $questionId,
            'user_answer' => $answer,
        ]);
    }

    return redirect()->route('quiz.evaluate')->with('success', 'Your answers have been saved!');
}
public function evaluateQuiz(Request $request)
{
    // Assuming you have the user's answers stored in the `temp_correct_answers` table
    $userAnswers = DB::table('temp_correct_answers')->get();

    $score = 0;
    $totalQuestions = count($userAnswers);
    
    foreach ($userAnswers as $userAnswer) {
        // Find the corresponding correct answer in the 'answers' table
        $correctAnswer = DB::table('answers')
            ->where('answer_text', $userAnswer->user_answer)
            ->where('is_correct', true)
            ->first();

        if ($correctAnswer) {
            $score++;
        }
    }

    // Calculate percentage score
    $percentageScore = $totalQuestions > 0 ? ($score / $totalQuestions) * 100 : 0;

    // Delete temporary answers
    DB::table('temp_correct_answers')->truncate();

    return view('result', compact('score', 'totalQuestions', 'percentageScore'));
}



}
