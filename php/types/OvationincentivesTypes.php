<?php
declare(strict_types=1);

// Typed models for the Ovationincentives SDK.
//
// GENERATED from the API model: main.kit.entity.<e>.fields[] and per-op
// params (op.<name>.points[].args.params[]). Field/param types come from the
// canonical type sentinels via @voxgig/sdkgen canonToType (source of truth:
// @voxgig/apidef VALID_CANON). Do not edit by hand.
//
// These are documentation-grade value objects (PHP 8 typed properties),
// registered on the composer classmap autoload. The SDK boundary exchanges
// assoc-arrays; these classes name the shapes for tooling and typed callers.

/** Code entity data model. */
class Code
{
    public ?string $catalog_id = null;
    public ?string $created_at = null;
    public ?float $denomination = null;
    public ?string $id = null;
    public ?string $recipient_email = null;
    public ?string $status = null;
}

/** Request payload for Code#load. */
class CodeLoadMatch
{
    public string $id;
}

/** Request payload for Code#create. */
class CodeCreateData
{
    public ?string $catalog_id = null;
    public ?string $created_at = null;
    public ?float $denomination = null;
    public ?string $id = null;
    public ?string $recipient_email = null;
    public ?string $status = null;
}

