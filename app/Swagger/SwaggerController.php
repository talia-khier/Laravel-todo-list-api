<?php

namespace App\Swagger;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="My API",
 *     description="This is the API documentation for My App",
 *
 *     @OA\Contact(
 *         email="your-email@example.com"
 *     )
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 *
 * @OA\SecurityRequirement(
 *     securityScheme="bearerAuth"
 * )
 */
class SwaggerController {}
