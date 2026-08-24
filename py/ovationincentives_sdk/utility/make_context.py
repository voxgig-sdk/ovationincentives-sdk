# Ovationincentives SDK utility: make_context

from ovationincentives_sdk.core.context import OvationincentivesContext


def make_context_util(ctxmap, basectx):
    return OvationincentivesContext(ctxmap, basectx)
