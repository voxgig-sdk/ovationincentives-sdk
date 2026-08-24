<?php
declare(strict_types=1);

// Ovationincentives SDK utility: prepare_body

class OvationincentivesPrepareBody
{
    public static function call(OvationincentivesContext $ctx): mixed
    {
        if ($ctx->op->input === 'data') {
            return ($ctx->utility->transform_request)($ctx);
        }
        return null;
    }
}
