<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ApiKeyForBooksAndAuthorsTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function test_api_key_is_required_for_book_store()
    {
        $response = $this->post('/api/books', [
            'title' => 'Book Title',
            'subtitle' => 'Book Subtitle',
            'publisher' => 'Book Publisher',
            'description' => 'Book Description',
        ]);

        $response->assertStatus(401);
    }

    #[Test]
    public function test_api_key_is_required_for_book_store_with_valid_api_key()
    {
        $response = $this->post('/api/books', [
            'title' => 'Book Title',
            'subtitle' => 'Book Subtitle',
            'publisher' => 'Book Publisher',
            'description' => 'Book Description',
        ], [
            'x-api-key' => config('app.api.api_key'),
        ]);

        $response->assertStatus(201);
    }

    #[Test]
    public function test_api_key_is_required_for_author_store()
    {
        $response = $this->post('/api/authors', [
            'firstname' => 'Author Firstname',
            'lastname' => 'Author Lastname',
        ]);

        $response->assertStatus(401);
    }

    #[Test]
    public function test_api_key_is_required_for_author_store_with_valid_api_key()
    {
        $response = $this->post('/api/authors', [
            'firstname' => 'Author Firstname',
            'lastname' => 'Author Lastname',
        ], [
            'x-api-key' => config('app.api.api_key'),
        ]);

        $response->assertStatus(201);
    }
}
