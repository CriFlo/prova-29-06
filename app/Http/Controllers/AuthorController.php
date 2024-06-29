<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Http\Resources\AuthorResource;
use App\Interfaces\AuthorRepositoryInterface;

class AuthorController extends Controller
{
    private AuthorRepositoryInterface $authorRepository;

    public function __construct(AuthorRepositoryInterface $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->authorRepository->index();

        return AuthorResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAuthorRequest $request)
    {
        $request->validated();

        return AuthorResource::make($this->authorRepository->store($request));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new AuthorResource($this->authorRepository->show($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAuthorRequest $request, string $id)
    {
        $request->validated();

        $data = $this->authorRepository->update($request, $id);

        return AuthorResource::make($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->authorRepository->destroy($id);
    }
}
