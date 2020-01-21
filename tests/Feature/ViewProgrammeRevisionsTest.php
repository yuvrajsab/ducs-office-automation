<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewProgrammeRevisionsTest extends TestCase
{
    use RefreshDatabase;

    /** @test*/
    public function guest_cannot_view_programme_revisions()
    {
        $programme = create('App\Programme');

        $this->withExceptionHandling()
            ->get("/programme/{$programme->id}/revision")
            ->assertRedirect('/login');
    }

    /** @test*/
    public function programme_revisions_can_be_viewed()
    {
        $this->signIn();
        $programme = create('App\Programme');
        $courses = create('App\Course', 2);
        $revisions = $programme->revisions()->createMany([
            ['revised_at' => now()],
            ['revised_at' => now()->addYear(1)->format('Y-m-d')],
        ]);

        $revisions[0]->courses()->attach($courses[0], ['semester' => 1]);
        $revisions[1]->courses()->attach($courses[1], ['semester' => 1]);

        $programmeRevisions = $this->withoutExceptionHandling()
            ->get("/programme/{$programme->id}/revision")
            ->assertSuccessful()
            ->assertViewIs('programmes.revisions.index')
            ->assertViewHasAll(['programme','programmeRevisions','groupedRevisionCourses'])
            ->viewData('programmeRevisions');
        
        $this->assertCount(2, $programmeRevisions);
    }
}
