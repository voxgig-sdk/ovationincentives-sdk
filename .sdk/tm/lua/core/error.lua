-- Ovationincentives SDK error

local OvationincentivesError = {}
OvationincentivesError.__index = OvationincentivesError


function OvationincentivesError.new(code, msg, ctx)
  local self = setmetatable({}, OvationincentivesError)
  self.is_sdk_error = true
  self.sdk = "Ovationincentives"
  self.code = code or ""
  self.msg = msg or ""
  self.ctx = ctx
  self.result = nil
  self.spec = nil
  return self
end


function OvationincentivesError:error()
  return self.msg
end


function OvationincentivesError:__tostring()
  return self.msg
end


return OvationincentivesError
