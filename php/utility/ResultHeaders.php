<?php
declare(strict_types=1);

// Ovationincentives SDK utility: result_headers

class OvationincentivesResultHeaders
{
    public static function call(OvationincentivesContext $ctx): ?OvationincentivesResult
    {
        $response = $ctx->response;
        $result = $ctx->result;
        if ($result) {
            if ($response && is_array($response->headers)) {
                $result->headers = $response->headers;
            } else {
                $result->headers = [];
            }
        }
        return $result;
    }
}
