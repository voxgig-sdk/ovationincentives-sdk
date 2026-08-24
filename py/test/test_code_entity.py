# Code entity test

import json
import os
import time

import pytest

from ovationincentives_sdk.utility.voxgig_struct import voxgig_struct as vs
from ovationincentives_sdk import OvationincentivesSDK
from ovationincentives_sdk.core import helpers

_TEST_DIR = os.path.dirname(os.path.abspath(__file__))
from test import runner


class TestCodeEntity:

    def test_should_create_instance(self):
        testsdk = OvationincentivesSDK.test(None, None)
        ent = testsdk.Code(None)
        assert ent is not None

    def test_should_run_basic_flow(self):
        setup = _code_basic_setup(None)
        # Per-op sdk-test-control.json skip — basic test exercises a flow with
        # multiple ops; skipping any one skips the whole flow (steps depend
        # on each other).
        _live = setup.get("live", False)
        for _op in ["create", "load"]:
            _skip, _reason = runner.is_control_skipped("entityOp", "code." + _op, "live" if _live else "unit")
            if _skip:
                pytest.skip(_reason or "skipped via sdk-test-control.json")
                return
        # The basic flow consumes synthetic IDs from the fixture. In live mode
        # without an *_ENTID env override, those IDs hit the live API and 4xx.
        if setup.get("synthetic_only"):
            pytest.skip("live entity test uses synthetic IDs from fixture — "
                        "set OVATIONINCENTIVES_TEST_CODE_ENTID JSON to run live")
        client = setup["client"]

        # CREATE
        code_ref01_ent = client.Code(None)
        code_ref01_data = helpers.to_map(vs.getprop(
            vs.getpath(setup["data"], "new.code"), "code_ref01"))

        code_ref01_data = helpers.to_map(runner.entity_data(code_ref01_ent.create(code_ref01_data, None)))
        assert code_ref01_data is not None
        assert code_ref01_data["id"] is not None

        # LOAD
        code_ref01_match_dt0 = {
            "id": code_ref01_data["id"],
        }
        code_ref01_data_dt0_loaded = code_ref01_ent.load(code_ref01_match_dt0, None)
        code_ref01_data_dt0_load_result = helpers.to_map(runner.entity_data(code_ref01_data_dt0_loaded))
        assert code_ref01_data_dt0_load_result is not None
        assert code_ref01_data_dt0_load_result["id"] == code_ref01_data["id"]



def _code_basic_setup(extra):
    runner.load_env_local()

    entity_data_file = os.path.join(_TEST_DIR, "../../.sdk/test/entity/code/CodeTestData.json")
    with open(entity_data_file, "r") as f:
        entity_data_source = f.read()

    entity_data = json.loads(entity_data_source)

    options = {}
    options["entity"] = entity_data.get("existing")

    client = OvationincentivesSDK.test(options, extra)

    # Generate idmap via transform.
    idmap = vs.transform(
        ["code01", "code02", "code03"],
        {
            "`$PACK`": ["", {
                "`$KEY`": "`$COPY`",
                "`$VAL`": ["`$FORMAT`", "upper", "`$COPY`"],
            }],
        }
    )

    # Detect ENTID env override before envOverride consumes it. When live
    # mode is on without a real override, the basic test runs against synthetic
    # IDs from the fixture and 4xx's. We surface this so the test can skip.
    _entid_env_raw = os.environ.get(
        "OVATIONINCENTIVES_TEST_CODE_ENTID")
    _idmap_overridden = _entid_env_raw is not None and _entid_env_raw.strip().startswith("{")

    env = runner.env_override({
        "OVATIONINCENTIVES_TEST_CODE_ENTID": idmap,
        "OVATIONINCENTIVES_TEST_LIVE": "FALSE",
        "OVATIONINCENTIVES_TEST_EXPLAIN": "FALSE",
        "OVATIONINCENTIVES_APIKEY": "NONE",
    })

    idmap_resolved = helpers.to_map(
        env.get("OVATIONINCENTIVES_TEST_CODE_ENTID"))
    if idmap_resolved is None:
        idmap_resolved = helpers.to_map(idmap)

    if env.get("OVATIONINCENTIVES_TEST_LIVE") == "TRUE":
        merged_opts = vs.merge([
            {
                "apikey": env.get("OVATIONINCENTIVES_APIKEY"),
            },
            extra or {},
        ])
        client = OvationincentivesSDK(helpers.to_map(merged_opts))

    _live = env.get("OVATIONINCENTIVES_TEST_LIVE") == "TRUE"
    return {
        "client": client,
        "data": entity_data,
        "idmap": idmap_resolved,
        "env": env,
        "explain": env.get("OVATIONINCENTIVES_TEST_EXPLAIN") == "TRUE",
        "live": _live,
        "synthetic_only": _live and not _idmap_overridden,
        "now": int(time.time() * 1000),
    }
