package voxgigovationincentivessdk

import (
	"github.com/voxgig-sdk/ovationincentives-sdk/go/core"
	"github.com/voxgig-sdk/ovationincentives-sdk/go/entity"
	"github.com/voxgig-sdk/ovationincentives-sdk/go/feature"
	_ "github.com/voxgig-sdk/ovationincentives-sdk/go/utility"
)

// Type aliases preserve external API.
type OvationincentivesSDK = core.OvationincentivesSDK
type Context = core.Context
type Utility = core.Utility
type Feature = core.Feature
type Entity = core.Entity
type OvationincentivesEntity = core.OvationincentivesEntity
type FetcherFunc = core.FetcherFunc
type Spec = core.Spec
type Result = core.Result
type Response = core.Response
type Operation = core.Operation
type Control = core.Control
type OvationincentivesError = core.OvationincentivesError

// BaseFeature from feature package.
type BaseFeature = feature.BaseFeature

func init() {
	core.NewBaseFeatureFunc = func() core.Feature {
		return feature.NewBaseFeature()
	}
	core.NewTestFeatureFunc = func() core.Feature {
		return feature.NewTestFeature()
	}
	core.NewCodeEntityFunc = func(client *core.OvationincentivesSDK, entopts map[string]any) core.OvationincentivesEntity {
		return entity.NewCodeEntity(client, entopts)
	}
}

// Constructor re-exports.
var NewOvationincentivesSDK = core.NewOvationincentivesSDK
var TestSDK = core.TestSDK
var NewContext = core.NewContext
var NewSpec = core.NewSpec
var NewResult = core.NewResult
var NewResponse = core.NewResponse
var NewOperation = core.NewOperation
var MakeConfig = core.MakeConfig
var SharedConfig = core.SharedConfig

// No-arg convenience constructors. Go has no default-argument syntax,
// so these aliases let callers write `sdk.New()` / `sdk.Test()`
// instead of `sdk.NewOvationincentivesSDK(nil)` / `sdk.TestSDK(nil, nil)`
// for the common no-options case.
func New() *OvationincentivesSDK  { return NewOvationincentivesSDK(nil) }
func Test() *OvationincentivesSDK { return TestSDK(nil, nil) }
var NewBaseFeature = feature.NewBaseFeature
var NewTestFeature = feature.NewTestFeature
