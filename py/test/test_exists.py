# Ovationincentives SDK exists test

import pytest
from ovationincentives_sdk import OvationincentivesSDK


class TestExists:

    def test_should_create_test_sdk(self):
        testsdk = OvationincentivesSDK.test(None, None)
        assert testsdk is not None
