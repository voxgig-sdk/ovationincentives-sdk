<?php
declare(strict_types=1);

// Ovationincentives SDK utility: make_context

require_once __DIR__ . '/../core/Context.php';

class OvationincentivesMakeContext
{
    public static function call(array $ctxmap, ?OvationincentivesContext $basectx): OvationincentivesContext
    {
        return new OvationincentivesContext($ctxmap, $basectx);
    }
}
