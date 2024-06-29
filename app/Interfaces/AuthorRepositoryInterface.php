<?php

namespace App\Interfaces;

use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;

interface AuthorRepositoryInterface
{
    public function index();
    public function store(StoreAuthorRequest $request);
    public function show($id);
    public function update(UpdateAuthorRequest $request, $id);
    public function destroy($id);
}
