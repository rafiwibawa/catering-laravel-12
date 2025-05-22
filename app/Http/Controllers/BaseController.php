<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    protected function sendSuccessResponse(int $code = 200, bool $status, string $message, $data)
    {
        return response()->json([
            'data' => $data,
            'success' => $status,
            'message' => $message,
        ], $code);
    }

    protected function sendErrorResponse(int $code = 200, bool $status, string $message, array $error)
    {
        return response()->json([
            'data' => null,
            'success' => $status,
            'error' => $error,
            'message' => $message,
        ], $code);
    }

    protected function sendPaginationList(int $code = 200, bool $status, string $message, $results)
    {
        return response()->json([
            'data' => $results->items(),
            'properties' => [
                'page' => $results->currentPage(),
                'total' => $results->total(),
                'total_page' => $results->lastPage(),
                'page_size' => $results->perPage(),
                'has_more_pages' => $results->hasMorePages(),
            ],
            'success' => $status,
            'message' => $message,
        ], $code);
    }
}
