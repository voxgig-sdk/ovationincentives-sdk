-- Typed models for the Ovationincentives SDK (LuaLS annotations).
--
-- GENERATED from the API model: main.kit.entity.<e>.fields[] and per-op
-- params (op.<name>.points[].args.params[]). Field/param types come from the
-- canonical type sentinels via @voxgig/sdkgen canonToType (source of truth:
-- @voxgig/apidef VALID_CANON). Annotations only — no runtime effect. Do not
-- edit by hand.

---@class Code
---@field catalog_id? string
---@field created_at? string
---@field denomination? number
---@field id? string
---@field recipient_email? string
---@field status? string

---@class CodeLoadMatch
---@field id string

---@class CodeCreateData
---@field catalog_id? string
---@field created_at? string
---@field denomination? number
---@field id? string
---@field recipient_email? string
---@field status? string

local M = {}

return M
