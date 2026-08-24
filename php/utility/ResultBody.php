<?php
declare(strict_types=1);

// Ovationincentives SDK utility: result_body

class OvationincentivesResultBody
{
    public static function call(OvationincentivesContext $ctx): ?OvationincentivesResult
    {
        $response = $ctx->response;
        $result = $ctx->result;
        if ($result && $response && $response->json_func && $response->body) {
            $result->body = ($response->json_func)();
        }
        return $result;
    }
}
