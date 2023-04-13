<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Traits\CustomModelTrait;
use App\Traits\HasApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class CrudController extends Controller
{
    use HasApiResponse, CustomModelTrait;

    protected $model, $modelName, $columnName = 'name';

    public function __construct()
    {
        $model = Route::current()->parameter('model');
        $this->modelName = $this->camelize($model);
        $className = "App\Models\\" . $this->camelize($model);
        $this->model = new $className;

        //drive type, body type, transmission
        if($this->modelName === 'DriveType' || $this->modelName === 'BodyType' || $this->modelName === 'Transmission') {
            $this->columnName = 'title';
        }
    }

    public function index()
    {
        $modelName = $this->modelName;
        $columnName = $this->columnName;
        return view('master.index', compact('modelName', 'columnName'));
    }

    public function list()
    {
        $model = $this->model;

        $queries = request()->has("query")
            ? json_decode(request()->input("query"))
            : [];

        foreach ($queries as $field => $query) {
            if (is_string($query)) {
                if ($field === "search") {
                    $model = $model->where(
                        $this->columnName,
                        "LIKE",
                        "%{$query}%"
                    );
                } else {
                    $model = $model->where(
                        $field,
                        "LIKE",
                        "%{$query}%"
                    );
                }
            }
        }

        if (request()->has("orderBy")) {
            $direction = request()->ascending === "true" ? "ASC" : "DESC";
            $model = $model->orderBy(request()->orderBy, $direction);
        }

        return $this->apiSuccess($this->paginateOrGet($model));
    }

    public function store(Request $request)
    {
        $unique = "unique:App\Models\\" . $this->modelName . ',' . $this->columnName;

        $request->validate([
            $this->columnName => 'required|string|max:50|' . $unique,
        ]);

        $datum = $this->model->create($request->only([$this->columnName]));

        return $this->apiCreated($datum);
    }

    public function update(Request $request, $model, $id)
    {
        $unique = "unique:App\Models\\" . $this->modelName . ',' . $this->columnName . ',' . $id;

        $request->validate([
            $this->columnName => 'required|string|max:50|' . $unique,
        ]);

        $datum = $this->model->findOrFail($id);
        $datum = $datum->update($request->only([$this->columnName]));

        return $this->apiUpdated($datum);
    }

    public function destroy($model, $id)
    {
        $datum = $this->model->findOrFail($id);

        //Restrict Deleting Others in Brand and Make
        if (($this->modelName === 'ProductMake' || $this->modelName === 'ProductBrand') && $datum->name === 'Others') {
            return $this->apiError('Others model cannot be deleted');
        }

        $datum->delete();
        return $this->apiDeleted();
    }

    private function camelize($input, $separator = '-')
    {
        return str_replace($separator, '', ucwords($input, $separator));
    }
}
