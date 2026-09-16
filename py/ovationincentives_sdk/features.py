# Ovationincentives SDK feature factory

from ovationincentives_sdk.feature.base_feature import OvationincentivesBaseFeature
from ovationincentives_sdk.feature.debug_feature import OvationincentivesDebugFeature
from ovationincentives_sdk.feature.idempotency_feature import OvationincentivesIdempotencyFeature
from ovationincentives_sdk.feature.metrics_feature import OvationincentivesMetricsFeature
from ovationincentives_sdk.feature.paging_feature import OvationincentivesPagingFeature
from ovationincentives_sdk.feature.ratelimit_feature import OvationincentivesRatelimitFeature
from ovationincentives_sdk.feature.retry_feature import OvationincentivesRetryFeature
from ovationincentives_sdk.feature.test_feature import OvationincentivesTestFeature
from ovationincentives_sdk.feature.timeout_feature import OvationincentivesTimeoutFeature


_FEATURES = {
    "base": lambda: OvationincentivesBaseFeature(),
    "debug": lambda: OvationincentivesDebugFeature(),
    "idempotency": lambda: OvationincentivesIdempotencyFeature(),
    "metrics": lambda: OvationincentivesMetricsFeature(),
    "paging": lambda: OvationincentivesPagingFeature(),
    "ratelimit": lambda: OvationincentivesRatelimitFeature(),
    "retry": lambda: OvationincentivesRetryFeature(),
    "test": lambda: OvationincentivesTestFeature(),
    "timeout": lambda: OvationincentivesTimeoutFeature(),
}


def _make_feature(name):
    factory = _FEATURES.get(name)
    if factory is not None:
        return factory()
    return _FEATURES["base"]()


# True when this SDK was generated with the named feature class - the
# constructor's tolerance for extend-carried features reads this (an
# active name with no generated class must not become a BaseFeature
# stray when an extend instance carries it).
def _has_feature(name):
    return name in _FEATURES
