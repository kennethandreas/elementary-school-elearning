<div align="center">

# Elementary School E-Learning Platform

**One platform for students, teachers, parents and school administrators.**

An e-learning website built for **SDN Susukan 08 Pagi** (Susukan 08 Pagi Public Elementary School) that brings learning materials, timed quizzes, daily learning habits and progress tracking together — with a dedicated portal for every role.

![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?logo=mysql&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4-06B6D4?logo=tailwindcss&logoColor=white)
![Vite](https://img.shields.io/badge/Vite-7-646CFF?logo=vite&logoColor=white)

*Software Project Management (Pengelolaan Proyek Perangkat Lunak) — Course Project*

</div>

---

## Table of Contents

- [Overview](#overview)
- [User Roles](#user-roles)
- [Features](#features)
- [Gamification](#gamification)
- [Tech Stack](#tech-stack)
- [Getting Started](#getting-started)
- [Project Structure](#project-structure)
- [Academic Context](#academic-context)
- [Author](#author)

## Overview

SDN Susukan 08 Pagi needed a simple, child-friendly way to deliver learning materials and assessments online, while keeping teachers and parents involved in each student's progress. This platform provides:

- A **student portal** for reading materials, taking quizzes and building daily learning habits
- A **teacher workspace** for publishing content and monitoring scores
- A **parent view** for following a child's progress without needing a separate account
- An **admin panel** for managing users and approving new registrations

## User Roles

Each role has its own login page, dashboard and permissions (enforced by role-based middleware).

| Role        | Capabilities                                                                                                   |
|-------------|----------------------------------------------------------------------------------------------------------------|
| **Student** | Read learning materials, take quizzes, complete the daily checklist, earn points and badges, chat with the learning assistant |
| **Teacher** | Manage learning materials and quizzes, build quiz questions, set quiz duration and passing score, view student scores |
| **Parent**  | View their child's learning progress and quiz results                                                          |
| **Admin**   | Manage student and teacher accounts, approve or reject registrations, manage homepage images                  |

## Features

### Students
- **Learning materials** — lessons with text, images and attachments, filtered by grade, with a *mark as complete* action
- **Timed quizzes** — multiple-choice quizzes with difficulty levels and a passing score; a countdown timer finishes the attempt automatically when time runs out, followed by a results page
- **Daily learning checklist** — daily tasks that award points when completed
- **Learning assistant** — a chatbot that suggests relevant materials based on keywords defined by teachers
- **Activity history** — an overview of completed materials and quiz attempts

### Teachers
- Dashboard summarizing materials, quizzes and student activity
- Create, edit and delete learning materials, including keywords for the learning assistant
- Create quizzes per grade with duration, difficulty and passing score
- Question builder for multiple-choice questions with points per question
- Student score overview with search

### Parents
- Lightweight login using the child's **NISN** (national student ID) and date of birth — no separate parent account required
- Dashboard and progress report showing quiz results and learning activity

### Administrators
- Student and teacher management (create, edit, delete)
- Registration approval queue — new accounts stay **pending** until an admin approves or rejects them
- Homepage image manager for the landing page

## Gamification

Students earn points by completing daily checklist tasks and progress through four badge tiers:

| Badge        | Points  |
|--------------|---------|
| 🥈 Silver    | 1 – 20  |
| 🥇 Gold      | 21 – 30 |
| 💠 Platinum  | 31 – 50 |
| 💎 Diamond   | 51+     |

## Tech Stack

| Layer           | Technology                               |
|-----------------|------------------------------------------|
| Backend         | Laravel 12, PHP 8.2+                     |
| Frontend        | Blade templates, Tailwind CSS 4, JavaScript |
| Database        | MySQL                                    |
| Build tool      | Vite 7                                   |
| Version control | Git & GitHub                             |

## Getting Started

### Prerequisites

- PHP 8.2+ and Composer
- MySQL (XAMPP or a similar local server)
- Node.js and npm

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/kennethandreas/elementary-school-elearning.git
   cd elementary-school-elearning
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Configure the environment**
   ```bash
   cp .env.example .env        # Windows: copy .env.example .env
   php artisan key:generate
   ```
   Create a new MySQL database (for example via phpMyAdmin) and set its name in `DB_DATABASE` inside `.env`.

4. **Run migrations and seed sample data**
   ```bash
   php artisan migrate:fresh --seed
   ```

5. **Link the storage folder** (for uploaded images and attachments)
   ```bash
   php artisan storage:link
   ```

6. **Start the app**
   ```bash
   npm run dev
   php artisan serve
   ```

Open **http://127.0.0.1:8000**.

> [!IMPORTANT]
> The seeders create a default admin account, sample student and teacher accounts, badge tiers and learning-assistant keywords. Login details are in `database/seeders/`. Change the admin password after your first login.

## Project Structure

```
├── app/
│   ├── Http/Controllers/     Auth, Dashboard, Materi, Quiz, Question, Checklist,
│   │                         AI (learning assistant), Teacher, Parent, Admin
│   ├── Http/Middleware/      Role-based access (EnsureRole, RedirectByRole)
│   └── Models/               User, Materi, Quiz, QuizQuestion, QuizAttempt,
│                             QuizAnswer, DailyChecklist, Badge, AiKeyword, ...
├── database/
│   ├── migrations/           Users, materials, quizzes, attempts, checklists, badges
│   └── seeders/              Admin, test users, badges, learning-assistant keywords
├── resources/views/
│   ├── auth/                 Separate login / register pages per role
│   ├── materi/  quiz/  aktivitas/  ai/
│   └── teacher/  parent/  admin/
└── routes/web.php            Routes grouped by role
```

## Academic Context

This project was developed for the **Software Project Management (Pengelolaan Proyek Perangkat Lunak)** course. It covered the full project lifecycle — requirements gathering, planning, development and version control with Git and GitHub — for a real school use case: SDN Susukan 08 Pagi.

## Author

**Kenneth Andreas** — [@kennethandreas](https://github.com/kennethandreas)

---

<div align="center">
<sub>Released under the MIT License.</sub>
</div>
