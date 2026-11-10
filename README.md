# E-Learning Website for SDN Susukan 08 Pagi

**Software Project Management course project**

A learning platform for an Indonesian public elementary school (SDN Susukan 08 Pagi, Jakarta) that
connects students, teachers, parents and school administrators. Teachers publish learning materials and
quizzes per class, students learn and build daily study habits through gamification, and parents can
follow their child's progress without needing a separate account.

![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?logo=laravel&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4-06B6D4?logo=tailwindcss&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8-4479A1?logo=mysql&logoColor=white)

---

## Features by Role

### Student
- Sign in with NISN (national student number) and password.
- Learning materials filtered by class, with completion tracking.
- Quizzes with difficulty levels, passing score, timed attempts and result review.
- **Daily checklist** of study habits that awards points; points unlock badges
  (Silver → Gold → Platinum → Diamond).
- **Learning assistant** chat that matches a question against material keywords and returns the
  relevant material.
- Profile management.

### Teacher
- Dashboard with class activity and quiz performance overview.
- Create and manage materials (per class, with search keywords for the learning assistant).
- Quiz builder with question bank, difficulty and passing score.
- Student score recap per quiz and class.

### Parent
- Access without registration: the parent verifies the child's NISN **and** date of birth,
  and the report is bound to that verified session (it cannot be switched to another student).
- Brute-force protection: rate limiting per NISN and per IP, with a single generic error message
  so NISNs cannot be enumerated.
- Progress report: quiz history with score, correct/incorrect answers, status and time spent.

### Administrator
- Manage student and teacher accounts.
- Approve or reject new registrations before they can sign in.
- Manage landing page images.

## Architecture

```
app/Http/Controllers/   Auth, Dashboard, Materi, Quiz, Question, Checklist, AI, Teacher, Parent, Admin
app/Http/Middleware/    EnsureAuthenticated, EnsureRole, RedirectByRole (role-based access)
app/Models/             User, Materi, Quiz, QuizQuestion, QuizAttempt, QuizAnswer,
                        AktivitasPembelajaran, DailyChecklist, Badge, AiKeyword
database/migrations/    Versioned schema (users & roles, materials, quizzes, attempts, checklists, badges)
database/seeders/       Admin account, demo users, badges, assistant keywords
resources/views/        Blade views per role (student, teacher, parent, admin)
```

Access control is enforced with custom middleware: every route group declares the role it serves, and
users are redirected to their own dashboard after sign-in.

## Tech Stack

| Layer | Technology |
|---|---|
| Backend | PHP 8.2, Laravel 12 |
| Frontend | Blade, Tailwind CSS 4, Vite 7, vanilla JavaScript |
| Database | MySQL / MariaDB |
| Testing | PHPUnit |

## Getting Started

**Requirements:** PHP 8.2+, Composer, Node.js, MySQL (XAMPP or Laragon works).

```bash
git clone https://github.com/kennethandreas/elementary-school-elearning.git
cd elementary-school-elearning

composer install
npm install
cp .env.example .env
php artisan key:generate
```

Create an empty database, set `DB_DATABASE`, `DB_USERNAME` and `DB_PASSWORD` in `.env`, then:

```bash
php artisan migrate:fresh --seed
php artisan storage:link
npm run dev
php artisan serve           # http://127.0.0.1:8000
```

### Demo accounts (seeded, local use only)

| Role | Login | Password |
|---|---|---|
| Administrator | `admin` | `admin123` |
| Teacher | `testguru` / `guru1@example.com` | `password` |
| Student | NISN `123456789012` | `password` |
| Parent | NISN `123456789012` + date of birth `2010-01-01` | — |

Change these credentials before any public deployment.

### Tests

```bash
npm run build               # views use Vite assets
php artisan test            # includes ParentAccessTest (access control & rate limiting)
```

## License

Released under the [MIT License](LICENSE). The school name and logo belong to SDN Susukan 08 Pagi.
