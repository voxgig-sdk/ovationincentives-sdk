package core

var UtilityRegistrar func(u *Utility)

var NewBaseFeatureFunc func() Feature

var NewTestFeatureFunc func() Feature

var NewCodeEntityFunc func(client *OvationincentivesSDK, entopts map[string]any) OvationincentivesEntity

