package core

type OvationincentivesError struct {
	IsOvationincentivesError bool
	Sdk              string
	Code             string
	Msg              string
	Ctx              *Context
	Result           any
	Spec             any
}

func NewOvationincentivesError(code string, msg string, ctx *Context) *OvationincentivesError {
	return &OvationincentivesError{
		IsOvationincentivesError: true,
		Sdk:              "Ovationincentives",
		Code:             code,
		Msg:              msg,
		Ctx:              ctx,
	}
}

func (e *OvationincentivesError) Error() string {
	return e.Msg
}
