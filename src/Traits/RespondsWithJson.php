<?php

namespace Firevel\ApiResourceGenerator\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response as IlluminateResponse;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

trait RespondsWithJson
{
    /**
     * @var int
     */
    protected $statusCode = 200;

    /**
     * Respond with HTTP_OK.
     *
     * @return JsonResponse
     */
    protected function respondSuccess(): JsonResponse
    {
        return $this->setStatusCode(200)
            ->respond([
                'data' => ['message' => 'success'],
            ]);
    }

    /**
     * Respond with HTTP_NOT_FOUND.
     *
     * @return JsonResponse
     */
    protected function respondNotFound(): JsonResponse
    {
        return $this->setStatusCode(SymfonyResponse::HTTP_NOT_FOUND)
            ->respondWithError('HTTP_NOT_FOUND');
    }

    /**
     * Respond with HTTP_METHOD_NOT_ALLOWED.
     *
     * @return JsonResponse
     */
    protected function respondNotAllowed(): JsonResponse
    {
        return $this->setStatusCode(SymfonyResponse::HTTP_METHOD_NOT_ALLOWED)
            ->respondWithError('HTTP_METHOD_NOT_ALLOWED');
    }

    /**
     * Respond with HTTP_UNPROCESSABLE_ENTITY.
     *
     * @return JsonResponse
     */
    protected function respondValidationError(): JsonResponse
    {
        return $this->setStatusCode(SymfonyResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->respondWithError('HTTP_UNPROCESSABLE_ENTITY');
    }

    /**
     * Respond with HTTP_UNAUTHORIZED.
     * @return JsonResponse
     */
    protected function respondUnauthorized(): JsonResponse
    {
        return $this->setStatusCode(SymfonyResponse::HTTP_UNAUTHORIZED)
            ->respondWithError('HTTP_UNAUTHORIZED');
    }

    /**
     * Respond with error.
     *
     * @param $status
     * @return JsonResponse
     */
    protected function respondWithError($status): JsonResponse
    {
        return $this->respond([
            'errors' => [
                [
                    'status' => $status,
                    'code' => $this->getStatusCode(),
                ],
            ],
        ]);
    }

    /**
     * Generate JSON response.
     *
     * @param array $data
     * @param array|null $headers
     * @return JsonResponse
     */
    protected function respond(array $data, ?array $headers = []): JsonResponse
    {
        return IlluminateResponse::json($data, $this->getStatusCode(), $headers);
    }

    /**
     * Set HTTP status code.
     *
     * @param int $statusCode
     * @return self
     */
    protected function setStatusCode(int $statusCode): self
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * Get HTTP status code.
     *
     * @return int
     */
    protected function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
