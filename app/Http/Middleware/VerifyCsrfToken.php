<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/exam_result'
        '/exam_result_analysis_score',
        '/exam_result_analysis_attempt',
        '/exam_result_analysis_rank'
    ];
}
