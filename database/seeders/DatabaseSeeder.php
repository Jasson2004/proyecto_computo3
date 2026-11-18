<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Pareja de estudiantes administradores (Rúbrica: exactamente dos estudiantes por equipo)
        $student1 = User::create([
            'name' => 'Carlos Hernández (Integrante 1)',
            'carnet' => 'HH22015',
            'email' => 'admin1@ues.edu.sv',
            'password' => Hash::make('Sistemas2026!'),
            'role' => 'admin',
        ]);

        $student2 = User::create([
            'name' => 'María López (Integrante 2)',
            'carnet' => 'LL22048',
            'email' => 'admin2@ues.edu.sv',
            'password' => Hash::make('Sistemas2026!'),
            'role' => 'admin',
        ]);

        // Usuario normal para pruebas de restricción de acceso
        User::create([
            'name' => 'Estudiante Visitante',
            'carnet' => 'VV23001',
            'email' => 'usuario@ues.edu.sv',
            'password' => Hash::make('Usuario2026!'),
            'role' => 'user',
        ]);

        // 7 Actividades obligatorias del documento
        $activities = [
            ['name' => 'Ponencias', 'min_content_guide' => 'Tema, expositor, ideas centrales y aprendizajes.'],
            ['name' => 'Talleres', 'min_content_guide' => 'Herramientas, procedimiento, práctica y resultados.'],
            ['name' => 'Bingo', 'min_content_guide' => 'Dinámica, experiencia y participación.'],
            ['name' => 'Feria de proyectos', 'min_content_guide' => 'Proyectos visitados, tecnologías e innovación.'],
            ['name' => 'Comelona de pizza', 'min_content_guide' => 'Desarrollo, convivencia y experiencia.'],
            ['name' => 'Torneo de fútbol sala', 'min_content_guide' => 'Desarrollo, equipos y participación como jugador o espectador.'],
            ['name' => 'Parrillada', 'min_content_guide' => 'Descripción, convivencia y reflexión.'],
        ];

        foreach ($activities as $activity) {
            Category::create($activity);
        }

        // Entrada inicial publicada de ejemplo
        $ponencia = Category::where('name', 'Ponencias')->first();
        $post = Post::create([
            'user_id' => $student1->id,
            'category_id' => $ponencia->id,
            'title' => 'Inauguración y Ponencia Magistral: Inteligencia Artificial Aplicada',
            'slug' => 'inauguracion-ponencia-ia-2026',
            'activity_date' => '2026-11-16',
            'excerpt' => 'Resumen de la jornada inaugural en la Facultad Multidisciplinaria Oriental sobre arquitecturas modernas.',
            'content' => "Durante el primer día de la Semana de Sistemas 2026 asistimos a la ponencia principal en el auditorio de la FMO.\n\nIdeas centrales: El expositor destacó cómo el desarrollo backend robusto con frameworks como Laravel sigue siendo el núcleo para integrar servicios de IA en producción.\n\nReflexión propia: Como equipo comprendimos la importancia de validar datos y diseñar arquitecturas limpias antes de escalar cualquier aplicación.",
            'status' => 'published',
            'published_at' => now(),
        ]);

        $post->authors()->sync([$student1->id, $student2->id]);
    }
}