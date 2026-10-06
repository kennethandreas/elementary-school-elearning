# Elementary School E-Learning Website

An e-learning website for **Susukan 08 Pagi Public Elementary School (SDN Susukan 08 Pagi)**. It brings students, teachers, parents and school administrators together in one platform for learning materials, quizzes and progress tracking.

Developed for the **Software Project Management (Pengelolaan Proyek Perangkat Lunak)** course.

![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?logo=mysql&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4-06B6D4?logo=tailwindcss&logoColor=white)
![Vite](https://img.shields.io/badge/Vite-7-646CFF?logo=vite&logoColor=white)

---

## User Roles

The website has four roles, each with its own login page and dashboard.

| Role | What they can do |
|---|---|
| **Student** | Read learning materials, take quizzes, complete the daily checklist, earn points and badges, and ask the learning assistant |
| **Teacher** | Manage learning materials and quizzes, build quiz questions, adjust quiz time and view student scores |
| **Parent** | View their child's learning progress and quiz results |
| **Admin** | Manage student and teacher accounts, approve new registrations and manage homepage images |

## Features

### For students
- **Learning materials** – lessons with text, images and attachments, filtered by grade, with a "mark as complete" option
- **Quizzes** – timed multiple-choice quizzes with difficulty levels and a passing score, plus a results page after each attempt
- **Daily learning checklist** – daily tasks that award points when completed
- **Points and badges** – students collect points and move up through **Silver, Gold, Platinum and Diamond** badges
- **Learning assistant chatbot** – students type a question, and the assistant suggests matching materials based on keywords set by the teacher
- **Activity history** – overview of completed materials and quiz attempts

### For teachers
- Teacher dashboard with a summary of materials, quizzes and student activity
- Create, edit and delete learning materials, with keywords for the learning assistant
- Create quizzes per grade, with duration, difficulty and passing score
- Question builder for multiple-choice questions with points per question
- Adjust quiz time while a quiz is running
- Student score overview with search

### For parents
- Simple login using the child's **NISN** (national student ID) and date of birth, so no separate parent account is needed
- Dashboard and progress report showing the child's quiz results and learning activity

### For administrators
- Student and teacher management (create, edit, delete)
- Approval queue for new registrations, so new accounts stay *pending* until an admin approves or rejects them
- Homepage image manager for the landing page

## Tech Stack

| Layer | Technology |
|---|---|
| Backend | Laravel 12, PHP 8.2+ |
| Frontend | Blade templates, Tailwind CSS 4, JavaScript |
| Database | MySQL (XAMPP) |
| Build tool | Vite |
| Version control | Git and GitHub |

## Getting Started

### Requirements
- XAMPP (Apache and MySQL) or a similar local server
- PHP 8.2 or newer
- Composer
- Node.js and npm

### Installation

1. Start **Apache** and **MySQL** in XAMPP.
2. Clone the repository and open a terminal in the project folder:
   ```bash
   git clone https://github.com/<your-username>/elementary-school-elearning.git
   cd elementary-school-elearning
   ```
3. Install dependencies:
   ```bash
   composer install
   npm install
   ```
4. Copy the environment file and generate the app key:
   ```bash
   cp .env.example .env        # Windows: copy .env.example .env
   php artisan key:generate
   ```
5. Create a new database in phpMyAdmin and set its name in `.env` (`DB_DATABASE`).
6. Run migrations with seed data:
   ```bash
   php artisan migrate:fresh --seed
   ```
7. Link the storage folder (for uploaded images and files):
   ```bash
   php artisan storage:link
   ```
8. Build assets and start the server:
   ```bash
   npm run dev
   php artisan serve
   ```

Open `http://127.0.0.1:8000`.

> The seeders create a default admin account, sample users, badges and chatbot keywords. Check `database/seeders/` for the login details and **change the admin password after your first login.**

## Project Structure

```
app/
├── Http/Controllers/     Auth, Dashboard, Materi, Quiz, Question, Checklist,
│                         AI (learning assistant), Teacher, Parent, Admin
└── Models/               User, Materi, Quiz, QuizQuestion, QuizAttempt,
                          QuizAnswer, DailyChecklist, Badge, AiKeyword, ...
database/
├── migrations/           Users, materials, quizzes, attempts, checklists, badges
└── seeders/              Admin, test users, badges, chatbot keywords
resources/views/
├── auth/                 Separate login/register pages per role
├── quiz/  aktivitas/  ai/
├── teacher/  parent/  admin/
routes/web.php            Routes grouped by role
```

## Academic Context

This project was developed for the **Software Project Management (Pengelolaan Proyek Perangkat Lunak)** course. The project covered the full cycle, from requirements and planning to development and version control with Git and GitHub, for a real school use case: SDN Susukan 08 Pagi.
