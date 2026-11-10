<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\QuizAttempt;

class ParentController extends Controller
{
    public function dashboard(Request $request)
    {
        // The parent portal is the child's report page.
        return redirect()->route('report.student');
    }

    public function reportStudent(Request $request)
    {
        // Only the student verified at parent login (NISN + date of birth) may be viewed.
        // The student is never selected from request input.
        $student = User::where('id', session('parent_view_id'))
            ->where('role', 'student')
            ->first();

        if (! $student) {
            session()->forget('parent_view_id');

            return redirect()->route('login.parent');
        }

        // Get quiz results (latest first)
        $quizResults = QuizAttempt::where('user_id', $student->id)
            ->with('quiz')
            ->latest('created_at')
            ->get()
            ->map(function ($attempt) {
                return [
                    'id' => $attempt->id,
                    'quiz_title' => $attempt->quiz->judul ?? 'Quiz',
                    'score' => $attempt->nilai,
                    'correct' => $attempt->jumlah_benar,
                    'wrong' => $attempt->jumlah_salah,
                    'status' => $attempt->status,
                    'date' => $attempt->created_at,
                    'duration' => ($attempt->waktu_mulai && $attempt->waktu_selesai)
                        ? $attempt->waktu_mulai->diffInSeconds($attempt->waktu_selesai)
                        : null
                ];
            });

        return view('parent.report', [
            'student' => $student,
            'quizResults' => $quizResults,
        ]);
    }
}
