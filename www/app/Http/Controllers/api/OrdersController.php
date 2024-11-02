<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\OrdersRequest;
use App\Services\OrdersService;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(OrdersRequest $request)
    {
        $validatedData = $request->validated();

        $service = App()->make(OrdersService::class);
        try {
            $result = $service->process($validatedData);
        } catch(\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }

        return response()->json(['success' => 1, 'transformedData' => $result]);
    }
}
