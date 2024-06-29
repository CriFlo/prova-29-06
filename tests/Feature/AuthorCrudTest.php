<?php

namespace Tests\Feature;

use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AuthorCrudTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_create_an_author()
    {
        $response = $this->post('/api/authors', [
            'firstname' => 'Author Firstname',
            'lastname' => 'Author Lastname',
        ], [
            'x-api-key' => config('app.api.api_key'),
        ]);

        $response->assertStatus(201);
    }

    #[Test]
    public function it_can_list_authors()
    {
        $this->post('/api/authors', [
            'firstname' => 'Author Firstname',
            'lastname' => 'Author Lastname',
        ], [
            'x-api-key' => config('app.api.api_key'),
        ]);

        $response = $this->get('/api/authors', [
            'x-api-key' => config('app.api.api_key'),
        ]);

        $response->assertStatus(200);
    }

    #[Test]
    public function it_can_show_an_author()
    {
        $this->post('/api/authors', [
            'firstname' => 'Author Firstname',
            'lastname' => 'Author Lastname',
        ], [
            'x-api-key' => config('app.api.api_key'),
        ]);

        $author = Author::first();

        $response = $this->get('/api/authors/' . $author->id, [
            'x-api-key' => config('app.api.api_key'),
        ]);

        $response->assertStatus(200);
    }

    #[Test]
    public function it_can_update_an_author()
    {
        $this->post('/api/authors', [
            'firstname' => 'Author Firstname',
            'lastname' => 'Author Lastname',
        ], [
            'x-api-key' => config('app.api.api_key'),
        ]);

        $author = Author::first();

        $response = $this->put('/api/authors/' . $author->id, [
            'firstname' => 'Author Firstname Updated',
            'lastname' => 'Author Lastname Updated',
        ], [
            'x-api-key' => config('app.api.api_key'),
        ]);

        $this->assertEquals('Author Firstname Updated', $author->fresh()->firstname);
    }

    #[Test]
    public function it_can_delete_an_author()
    {
        $author = $this->post('/api/authors', [
            'firstname' => 'Author Firstname',
            'lastname' => 'Author Lastname',
        ], [
            'x-api-key' => config('app.api.api_key'),
        ])->getOriginalContent();
        
        $author = Author::findOrFail($author['id']);

        $response = $this->delete('/api/authors/' . $author->id, [], [
            'x-api-key' => config('app.api.api_key'),
        ]);

        $response->assertStatus(204);
    }
}
