<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogSystemTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_admin_can_login_and_access_dashboard(): void
    {
        $admin = User::where('email', 'admin1@ues.edu.sv')->first();

        $response = $this->post('/login', [
            'email' => $admin->email,
            'password' => 'Sistemas2026!',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->actingAs($admin)->get(route('admin.dashboard'))->assertStatus(200);
    }

    public function test_invalid_login_fails(): void
    {
        $response = $this->post('/login', [
            'email' => 'admin1@ues.edu.sv',
            'password' => 'ClaveIncorrecta',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_regular_user_cannot_access_admin_panel(): void
    {
        $user = User::where('role', 'user')->first();

        $this->actingAs($user)
            ->get(route('admin.dashboard'))
            ->assertStatus(403);
    }

    public function test_draft_posts_are_hidden_from_public_and_can_be_published(): void
    {
        $admin = User::where('email', 'admin1@ues.edu.sv')->first();
        $category = Category::first();

        // Crear borrador
        $this->actingAs($admin)->post(route('admin.posts.store'), [
            'title' => 'Taller de Docker y Laravel',
            'category_id' => $category->id,
            'activity_date' => '2026-11-17',
            'content' => 'Contenido detallado de la práctica realizada en el laboratorio de cómputo.',
            'authors' => [$admin->id],
            'action' => 'draft',
        ])->assertRedirect(route('admin.posts.drafts'));

        $draft = Post::where('title', 'Taller de Docker y Laravel')->first();
        $this->assertEquals('draft', $draft->status);

        // Verificar que no sea visible públicamente
        $this->get(route('home'))->assertDontSee('Taller de Docker y Laravel');
        $this->get(route('posts.show', $draft->slug))->assertStatus(404);

        // Publicar borrador
        $this->actingAs($admin)
            ->patch(route('admin.posts.publish', $draft))
            ->assertRedirect(route('admin.posts.index'));

        $this->get(route('home'))->assertSee('Taller de Docker y Laravel');
        $this->get(route('posts.show', $draft->slug))->assertStatus(200);
    }

    public function test_admin_can_delete_post_and_logout(): void
    {
        $admin = User::where('email', 'admin1@ues.edu.sv')->first();
        $post = Post::first();

        $this->actingAs($admin)
            ->delete(route('admin.posts.destroy', $post))
            ->assertRedirect();

        $this->assertDatabaseMissing('posts', ['id' => $post->id]);

        $this->actingAs($admin)
            ->post(route('logout'))
            ->assertRedirect(route('home'));

        $this->assertGuest();
    }
}