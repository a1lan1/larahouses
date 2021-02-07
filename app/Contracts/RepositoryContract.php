<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface RepositoryContract.
 */
interface RepositoryContract
{
    public function get(array $columns = ['*']): Collection;
    public function all(array $columns = ['*']): Collection;
    public function first(array $columns = ['*']);
    public function getById($id, array $columns = ['*']);
    public function getByColumn($item, $column, array $columns = ['*']);
    public function paginate($limit = 25, array $columns = ['*'], $pageName = 'page', $page = null);

    public function create(array $data): Model;
    public function createMultiple(array $data): Collection;
    public function updateById($id, array $data, array $options = []): Model;

    public function delete();
    public function deleteById($id): ?bool;
    public function deleteMultipleById(array $ids): int;

    public function where($column, $value, $operator = '=');
    public function whereIn($column, $value);

    public function limit($limit);
    public function orderBy($column, $value);
    public function with($relations);

    public function count(): int;
}
