<?php

namespace App\Repositories;

use App\Interfaces\BookRepositoryInterface;
use App\Models\Book;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class BookRepository implements BookRepositoryInterface
{
    public function index()
    {
        return Book::all();
    }

    public function store($request)
    {
        DB::beginTransaction();

        try {
            $book = Book::create($request->all());
            DB::commit();

            return $book;
        } catch (\Exception $e) {
            DB::rollBack();

            return $e->getMessage();
        }
    }

    public function show($id)
    {
        return Book::findOrFail($id);
    }

    public function update($request, $id)
    {
        DB::beginTransaction();

        try {
            $book = Book::find($id);
            $book->update($request->all());
            DB::commit();

            return $book;
        } catch (\Exception $e) {
            DB::rollBack();

            return $e->getMessage();
        }
    }

    public function destroy($id)
    {
        Book::destroy($id);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
