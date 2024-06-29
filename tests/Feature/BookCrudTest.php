<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class BookCrudTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_create_a_book()
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
    public function it_can_list_books()
    {
        $this->post('/api/books', [
            'title' => 'Book Title',
            'subtitle' => 'Book Subtitle',
            'publisher' => 'Book Publisher',
            'description' => 'Book Description',
        ], [
            'x-api-key' => config('app.api.api_key'),
        ]);

        $response = $this->get('/api/books', [
            'x-api-key' => config('app.api.api_key'),
        ]);

        $response->assertStatus(200);
    }

    #[Test]
    public function it_can_show_a_book()
    {
        $this->post('/api/books', [
            'title' => 'Book Title',
            'subtitle' => 'Book Subtitle',
            'publisher' => 'Book Publisher',
            'description' => 'Book Description',
        ], [
            'x-api-key' => config('app.api.api_key'),
        ]);

        $book = Book::first();

        $response = $this->get('/api/books/' . $book->id, [
            'x-api-key' => config('app.api.api_key'),
        ]);

        $response->assertStatus(200);
    }

    #[Test]
    public function it_can_update_a_book()
    {
        $this->post('/api/books', [
            'title' => 'Book Title',
            'subtitle' => 'Book Subtitle',
            'publisher' => 'Book Publisher',
            'description' => 'Book Description',
        ], [
            'x-api-key' => config('app.api.api_key'),
        ]);

        $book = Book::first();

        $response = $this->put('/api/books/' . $book->id, [
            'title' => 'Book Title Updated',
            'subtitle' => 'Book Subtitle Updated',
            'publisher' => 'Book Publisher Updated',
            'description' => 'Book Description Updated',
        ], [
            'x-api-key' => config('app.api.api_key'),
        ]);

        $response->assertStatus(200);
    }

    #[Test]
    public function it_can_delete_a_book()
    {
        $book = $response = $this->post('/api/books', [
            'title' => 'Book Title',
            'subtitle' => 'Book Subtitle',
            'publisher' => 'Book Publisher',
            'description' => 'Book Description',
        ], [
            'x-api-key' => config('app.api.api_key'),
        ])->getOriginalContent();

        $book = Book::findOrFail($book['id']);

        $response = $this->delete('/api/books/' . $book->id, [], [
            'x-api-key' => config('app.api.api_key'),
        ]);

        $response->assertStatus(204);
    }
}
