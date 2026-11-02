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
- [The Problem](#the-problem)
- [User Roles](#user-roles)
- [Product Decisions](#product-decisions)
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

## The Problem

The school needed to deliver learning materials and assessments online in a way young children can use on their own, while keeping teachers and parents involved in each student's progress. A single generic portal does not fit that, because the four groups of users need very different things:

| User | What they need | How the platform addresses it |
|------|----------------|-------------------------------|
| **Students** | Simple, age-appropriate materials and practice, and a reason to come back every day | Materials filtered by grade, timed quizzes with instant results, and a daily checklist that rewards learning habits with points and badges |
| **Teachers** | A way to publish content and check results without extra admin work | One workspace to publish materials, build quizzes with a passing score, and see every student's scores |
| **Parents** | Visibility into their child's progress without having to manage another account | A read-only progress view opened with the child's NISN and date of birth |
| **School admin** | Control over who can access a platform used by children | Central management of student and teacher accounts, with an approval step for every new registration |

<!-- [ISI: how the school delivered materials before this platform, and how these needs were gathered, e.g. interviews with teachers or the principal] -->

## User Roles

Each role has its own login page, dashboard and permissions (enforced by role-based middleware).

| Role        | Capabilities                                                                                                   |
|-------------|----------------------------------------------------------------------------------------------------------------|
| **Student** | Read learning materials, take quizzes, complete the daily checklist, earn points and badges, chat with the learning assistant |
| **Teacher** | Manage learning materials and quizzes, build quiz questions, set quiz duration and passing score, view student scores |
| **Parent**  | View their child's learning progress and quiz results                                                          |
| **Admin**   | Manage student and teacher accounts, approve or reject registrations, manage homepage images                  |

## Product Decisions

### Parent login with the child's NISN and date of birth

Parents sign in with their child's NISN (national student ID) and date of birth instead of creating their own account. The school already has both data points for every student, so parents do not need to register or remember another password. The trade-off is weaker authentication than a personal password, which is why the parent view is read-only: it shows progress and quiz results, but cannot change anything.

### Points for daily habits, badges for progress

Students earn 2 points for every completed daily checklist task, and move up four badge tiers (Silver, Gold, Platinum, Diamond) as their points grow. A pop-up celebrates each new tier. Points come from consistent daily activity, not from quiz scores, so every student can progress regardless of their current grades.

### Every new account needs admin approval

New student and teacher registrations stay *pending* until a school admin approves them. The platform is used by children, so only verified members of the school should be able to access it.

### A learning assistant driven by teacher keywords

The learning assistant suggests materials based on keywords that teachers define, instead of generating free-form answers. Teachers stay in control of what children see, and the answers are predictable.

<!--
## Screenshots

| Student dashboard | Quiz with timer |
|---|---|
| [ISI: screenshot of the student dashboard with points and badge] | [ISI: screenshot of a quiz in progress] |

| Teacher workspace | Parent view |
|---|---|
| [ISI: screenshot of the teacher dashboard or question builder] | [ISI: screenshot of the parent progress report] |

When filled in, remove this comment wrapper and add Screenshots back to the table of contents.
-->

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

<!-- [ISI: team size and your role in the team, if this was a group project] -->

<!--
## Project Management Artifacts

| Artifact | Description | Link |
|----------|-------------|------|
| Work Breakdown Structure (WBS) | Project scope broken down into deliverables and work packages | [ISI: link or image of the WBS] |
| Gantt chart | Schedule, milestones and dependencies | [ISI: link or image of the Gantt chart] |
| Risk register | Identified risks with likelihood, impact and mitigation | [ISI: link or image of the risk register] |

When filled in, remove this comment wrapper.
-->



## Author

**Kenneth Andreas** — [@kennethandreas](https://github.com/kennethandreas)

---

<div align="center">
<sub>Released under the MIT License.</sub>
</div>
