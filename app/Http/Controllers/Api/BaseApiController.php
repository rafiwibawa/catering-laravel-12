<?php 

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class BaseApiController extends Controller
{
    protected function sendSuccessResponse(bool $status, string $message, $data, int $code = 200)
    {
        return response()->json([
            'data' => $data,
            'success' => $status,
            'message' => $message,
        ], $code);
    }

    protected function sendErrorResponse(bool $status, string $message, array $error, int $code = 200)
    {
        return response()->json([
            'data' => null,
            'success' => $status,
            'error' => $error,
            'message' => $message,
        ], $code);
    } 

    protected function sendPaginationList(bool $status, string $message, $results, int $code = 200)
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
