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
            ->assertRedirect(route('login'));

        $this->assertGuest();
    }

    public function test_user_can_register_and_admin_can_promote_to_admin(): void
    {
        // 1. Registro público (siempre crea rol 'user')
        $this->post(route('register.store'), [
            'name' => 'Nuevo Estudiante',
            'carnet' => 'NE26001',
            'email' => 'nuevo@ues.edu.sv',
            'password' => 'ClaveSegura2026!',
            'password_confirmation' => 'ClaveSegura2026!',
        ])->assertRedirect(route('home'));

        $newUser = User::where('email', 'nuevo@ues.edu.sv')->first();
        $this->assertEquals('user', $newUser->role);

        // 2. El administrador lo promueve a admin
        $admin = User::where('email', 'admin1@ues.edu.sv')->first();
        $this->actingAs($admin)
            ->patch(route('admin.users.toggle-role', $newUser))
            ->assertRedirect();

        $this->assertEquals('admin', $newUser->fresh()->role);
    }

    public function test_admin_can_edit_category(): void
    {
        $admin = User::where('email', 'admin1@ues.edu.sv')->first();
        $category = Category::first();

        $this->actingAs($admin)
            ->put(route('admin.categories.update', $category), [
                'name' => 'Ponencias Magistrales',
                'min_content_guide' => 'Tema, ponente y conclusiones.',
                'description' => 'Charlas principales.',
            ])->assertRedirect(route('admin.categories.index'));

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'Ponencias Magistrales',
        ]);
    }
}