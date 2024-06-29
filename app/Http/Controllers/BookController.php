<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Interfaces\BookRepositoryInterface;

class BookController extends Controller
{
    private BookRepositoryInterface $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->bookRepository->index();

        return BookResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $request->validated();

        return BookResource::make($this->bookRepository->store($request));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new BookResource($this->bookRepository->show($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, string $id)
    {
        $request->validated();

        $data = $this->bookRepository->update($request, $id);

        return BookResource::make($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->bookRepository->destroy($id);
    }
}
