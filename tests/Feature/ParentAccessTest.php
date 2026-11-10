<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ParentAccessTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    private function student(string $nisn = '123456789012', string $birthDate = '2015-03-14'): User
    {
        return User::create([
            'name' => 'Murid ' . $nisn,
            'username' => 'murid' . $nisn,
            'email' => $nisn . '@example.com',
            'password' => Hash::make('password'),
            'role' => 'student',
            'nisn' => $nisn,
            'tanggal_lahir' => $birthDate,
            'kelas' => '1A',
        ]);
    }

    public function test_report_requires_parent_login(): void
    {
        $this->get(route('report.student'))->assertRedirect(route('login.parent'));
    }

    public function test_report_cannot_be_opened_with_nisn_query_parameter(): void
    {
        $student = $this->student();

        $this->get(route('report.student', ['nisn' => $student->nisn]))
            ->assertRedirect(route('login.parent'));
    }

    public function test_parent_can_view_report_after_verifying_nisn_and_birth_date(): void
    {
        $student = $this->student();

        $this->post(route('login.parent.post'), [
            'nisn' => $student->nisn,
            'tanggal_lahir' => '2015-03-14',
        ])->assertRedirect(route('parent.dashboard'));

        $this->get(route('parent.dashboard'))->assertRedirect(route('report.student'));

        $this->get(route('report.student'))
            ->assertOk()
            ->assertSee($student->name);
    }

    public function test_parent_session_cannot_switch_to_another_student(): void
    {
        $child = $this->student('111111111111');
        $other = $this->student('222222222222');

        $this->post(route('login.parent.post'), [
            'nisn' => $child->nisn,
            'tanggal_lahir' => '2015-03-14',
        ]);

        $this->get(route('report.student', ['nisn' => $other->nisn]))
            ->assertOk()
            ->assertSee($child->name)
            ->assertDontSee($other->name);
    }

    public function test_wrong_birth_date_and_unknown_nisn_return_the_same_error(): void
    {
        $student = $this->student();

        $wrongDate = $this->from(route('login.parent'))->post(route('login.parent.post'), [
            'nisn' => $student->nisn,
            'tanggal_lahir' => '2015-01-01',
        ]);
        $unknown = $this->from(route('login.parent'))->post(route('login.parent.post'), [
            'nisn' => '999999999999',
            'tanggal_lahir' => '2015-01-01',
        ]);

        $wrongDate->assertSessionHasErrors(['nisn' => 'NISN atau tanggal lahir tidak sesuai.']);
        $unknown->assertSessionHasErrors(['nisn' => 'NISN atau tanggal lahir tidak sesuai.']);
        $this->assertNull(session('parent_view_id'));
    }

    public function test_birth_date_guessing_is_rate_limited_per_nisn(): void
    {
        $student = $this->student();

        for ($i = 1; $i <= 5; $i++) {
            $this->post(route('login.parent.post'), [
                'nisn' => $student->nisn,
                'tanggal_lahir' => sprintf('2014-01-%02d', $i),
            ]);
        }

        // Even the correct date is rejected once the limit is reached.
        $this->post(route('login.parent.post'), [
            'nisn' => $student->nisn,
            'tanggal_lahir' => '2015-03-14',
        ])->assertSessionHasErrors('nisn');

        $this->assertNull(session('parent_view_id'));
    }

    public function test_parent_logout_ends_access(): void
    {
        $student = $this->student();

        $this->post(route('login.parent.post'), [
            'nisn' => $student->nisn,
            'tanggal_lahir' => '2015-03-14',
        ]);

        $this->post(route('logout.parent'))->assertRedirect(route('landing'));
        $this->get(route('report.student'))->assertRedirect(route('login.parent'));
    }
}
