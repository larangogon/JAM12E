<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="API products JAM12E",
 *      description="Implementation of Swagger with in Laravel",
 *      @OA\Contact(
 *          email="admin@example.com"
 *      ),
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      ),
 * ),
 *
 * @OA\Server(
 *     description="API JAM12E",
 *     url="http://127.0.0.1:8000"
 * )
 *
 */
/**
 * @OA\SecurityScheme(
 *     @OA\Flow(
 *         flow="password",
 *         tokenUrl="/oauth/token",
 *         authorizationUrl="/oauth/authorize",
 *         scopes={*}
 *     ),
 *
 *     securityScheme="passport",
 *     in="header",
 *     type="oauth2",
 *     scheme="bearer",
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;
}
