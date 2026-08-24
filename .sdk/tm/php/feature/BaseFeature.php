<?php
declare(strict_types=1);

// Ovationincentives SDK base feature

class OvationincentivesBaseFeature
{
    public string $version;
    public string $name;
    public bool $active;

    // Positions this feature when added via the client `extend` option:
    // "__before__" / "__after__" / "__replace__" name an already-added
    // feature (mirrors the ts feature `_options`). Declared so setting it
    // on an extension instance avoids the dynamic-property deprecation.
    public ?array $_options = null;

    public function __construct()
    {
        $this->version = '0.0.1';
        $this->name = 'base';
        $this->active = true;
    }

    public function get_version(): string { return $this->version; }
    public function get_name(): string { return $this->name; }
    public function get_active(): bool { return $this->active; }

    public function init(OvationincentivesContext $ctx, array $options): void {}
    public function PostConstruct(OvationincentivesContext $ctx): void {}
    public function PostConstructEntity(OvationincentivesContext $ctx): void {}
    public function SetData(OvationincentivesContext $ctx): void {}
    public function GetData(OvationincentivesContext $ctx): void {}
    public function GetMatch(OvationincentivesContext $ctx): void {}
    public function SetMatch(OvationincentivesContext $ctx): void {}
    public function PrePoint(OvationincentivesContext $ctx): void {}
    public function PreSpec(OvationincentivesContext $ctx): void {}
    public function PreRequest(OvationincentivesContext $ctx): void {}
    public function PreResponse(OvationincentivesContext $ctx): void {}
    public function PreResult(OvationincentivesContext $ctx): void {}
    public function PreDone(OvationincentivesContext $ctx): void {}
    public function PreUnexpected(OvationincentivesContext $ctx): void {}
}
