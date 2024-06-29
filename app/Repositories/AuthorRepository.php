<?php

namespace App\Repositories;

use App\Interfaces\AuthorRepositoryInterface;
use App\Models\Author;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class AuthorRepository implements AuthorRepositoryInterface
{
    public function index()
    {
        return Author::all();
    }

    public function store($request)
    {
        DB::beginTransaction();
        
        try {
            $author = Author::create($request->only('firstname', 'lastname'));

            if ($request->has('books')) {
                $author->books()->attach($request->books);
            }

            DB::commit();

            return $author;
        } catch (\Exception $e) {
            DB::rollBack();

            return $e->getMessage();
        }
    }

    public function show($id)
    {
        return Author::findOrFail($id);
    }

    public function update($request, $id)
    {
        DB::beginTransaction();

        try {
            $author = Author::find($id);
            $author->update($request->only('firstname', 'lastname'));

            if ($request->has('books')) {
                $author->books()->sync($request->books);
            }
            
            DB::commit();

            return $author;
        } catch (\Exception $e) {
            DB::rollBack();

            return $e->getMessage();
        }
    }

    public function destroy($id)
    {
        Author::destroy($id);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
