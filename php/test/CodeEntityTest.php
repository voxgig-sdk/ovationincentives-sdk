<?php
declare(strict_types=1);

// Code entity test

require_once __DIR__ . '/../ovationincentives_sdk.php';
require_once __DIR__ . '/Runner.php';

use PHPUnit\Framework\TestCase;
use Voxgig\Struct\Struct as Vs;

class CodeEntityTest extends TestCase
{
    public function test_create_instance(): void
    {
        $testsdk = OvationincentivesSDK::test(null, null);
        $ent = $testsdk->Code(null);
        $this->assertNotNull($ent);
    }

    public function test_basic_flow(): void
    {
        $setup = code_basic_setup(null);
        // Per-op sdk-test-control.json skip.
        $_live = !empty($setup["live"]);
        foreach (["create", "load"] as $_op) {
            [$_shouldSkip, $_reason] = Runner::is_control_skipped("entityOp", "code." . $_op, $_live ? "live" : "unit");
            if ($_shouldSkip) {
                $this->markTestSkipped($_reason ?? "skipped via sdk-test-control.json");
                return;
            }
        }
        // The basic flow consumes synthetic IDs from the fixture. In live mode
        // without an *_ENTID env override, those IDs hit the live API and 4xx.
        if (!empty($setup["synthetic_only"])) {
            $this->markTestSkipped("live entity test uses synthetic IDs from fixture — set OVATIONINCENTIVES_TEST_CODE_ENTID JSON to run live");
            return;
        }
        $client = $setup["client"];

        // CREATE
        $code_ref01_ent = $client->Code(null);
        $code_ref01_data = Helpers::to_map(Vs::getprop(
            Vs::getpath($setup["data"], "new.code"), "code_ref01"));

        $code_ref01_data_result = $code_ref01_ent->create($code_ref01_data, null);
        $code_ref01_data = Helpers::to_map(is_object($code_ref01_data_result) && method_exists($code_ref01_data_result, 'data_get') ? $code_ref01_data_result->data_get() : $code_ref01_data_result);
        $this->assertNotNull($code_ref01_data);
        $this->assertNotNull($code_ref01_data["id"]);

        // LOAD
        $code_ref01_match_dt0 = [
            "id" => $code_ref01_data["id"],
        ];
        $code_ref01_data_dt0_loaded = $code_ref01_ent->load($code_ref01_match_dt0, null);
        $code_ref01_data_dt0_load_result = Helpers::to_map(is_object($code_ref01_data_dt0_loaded) && method_exists($code_ref01_data_dt0_loaded, 'data_get') ? $code_ref01_data_dt0_loaded->data_get() : $code_ref01_data_dt0_loaded);
        $this->assertNotNull($code_ref01_data_dt0_load_result);
        $this->assertEquals($code_ref01_data_dt0_load_result["id"], $code_ref01_data["id"]);

    }
}

function code_basic_setup($extra)
{
    Runner::load_env_local();

    $entity_data_file = __DIR__ . '/../../.sdk/test/entity/code/CodeTestData.json';
    $entity_data_source = file_get_contents($entity_data_file);
    $entity_data = json_decode($entity_data_source, true);

    $options = [];
    $options["entity"] = $entity_data["existing"];

    $client = OvationincentivesSDK::test($options, $extra);

    // Generate idmap.
    $idmap = [];
    foreach (["code01", "code02", "code03"] as $k) {
        $idmap[$k] = strtoupper($k);
    }

    // Detect ENTID env override before envOverride consumes it. When live
    // mode is on without a real override, the basic test runs against synthetic
    // IDs from the fixture and 4xx's. Surface this so the test can skip.
    $entid_env_raw = getenv("OVATIONINCENTIVES_TEST_CODE_ENTID");
    $idmap_overridden = $entid_env_raw !== false && str_starts_with(trim($entid_env_raw), "{");

    $env = Runner::env_override([
        "OVATIONINCENTIVES_TEST_CODE_ENTID" => $idmap,
        "OVATIONINCENTIVES_TEST_LIVE" => "FALSE",
        "OVATIONINCENTIVES_TEST_EXPLAIN" => "FALSE",
        "OVATIONINCENTIVES_APIKEY" => "NONE",
    ]);

    $idmap_resolved = Helpers::to_map(
        $env["OVATIONINCENTIVES_TEST_CODE_ENTID"]);
    if ($idmap_resolved === null) {
        $idmap_resolved = Helpers::to_map($idmap);
    }

    if ($env["OVATIONINCENTIVES_TEST_LIVE"] === "TRUE") {
        $merged_opts = Vs::merge([
            [
                "apikey" => $env["OVATIONINCENTIVES_APIKEY"],
            ],
            $extra ?? [],
        ]);
        $client = new OvationincentivesSDK(Helpers::to_map($merged_opts));
    }

    $live = $env["OVATIONINCENTIVES_TEST_LIVE"] === "TRUE";
    return [
        "client" => $client,
        "data" => $entity_data,
        "idmap" => $idmap_resolved,
        "env" => $env,
        "explain" => $env["OVATIONINCENTIVES_TEST_EXPLAIN"] === "TRUE",
        "live" => $live,
        "synthetic_only" => $live && !$idmap_overridden,
        "now" => (int)(microtime(true) * 1000),
    ];
}
