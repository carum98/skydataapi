<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

/**
 * 
 */
trait ApiResponser
{
    private function successResponse($data, $code)
    {
        return response()->json($data, $code);
    }

    protected function errorResponse($message, $code)
    {
        return response()->json(['error'=>$message, 'code' => $code], $code);
    }

    protected function showAll(Collection $collection, $code = 200)
    {
        $collection = $this->shorData($collection);
        $collection = $this->paginate($collection);
        $collection = $this->cacheResponse($collection);
        return response()->json(['data'=> $collection], $code);
    }

    protected function shorData(Collection $collection)
    {   
        if (request()->has('sort_by')) {
            $attribute = request()->sort_by;
            $collection = $collection->sortBy($attribute);
        }
        return $collection;
    }

    public function paginate(Collection $collection)
    {
        $page = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 15;
        $result = $collection->slice(($page - 1) * $perPage, $perPage)->values();
        $paginated = new LengthAwarePaginator($result, $collection->count(), $perPage, $page,['path' => LengthAwarePaginator::resolveCurrentPath()]);
        $paginated->appends(request()->all());
        return $paginated;
    }

    public function cacheResponse($data)
    {
        $url = request()->url();
        $queryParams = request()->query();

        ksort($queryParams);

        $quryString = http_build_query($queryParams);

        $fulUrl = "{$url}?{$quryString}";
        return Cache::remember($fulUrl, 30/60, function() use($data) {
            return $data;
        });
    }
    
    protected function showOne(Model $instance, $code = 200)
    {
        return response()->json(['data'=> $instance], $code);
    }

    protected function showMessage($message, $code = 200)
    {
        return response()->json(['data'=> $message], $code);
    }
}
