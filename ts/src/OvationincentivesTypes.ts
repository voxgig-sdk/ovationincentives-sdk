// Typed models for the Ovationincentives SDK.
//
// GENERATED from the API model: main.kit.entity.<e>.fields[] and per-op
// params (op.<name>.points[].args.params[]). Field/param types come from the
// canonical type sentinels via @voxgig/sdkgen canonToType (source of truth:
// @voxgig/apidef VALID_CANON). Do not edit by hand.

export interface Code {
  catalog_id?: string
  created_at?: string
  denomination?: number
  id?: string
  recipient_email?: string
  status?: string
}

export interface CodeLoadMatch {
  catalog_id?: string
  created_at?: string
  denomination?: number
  id: string
  recipient_email?: string
  status?: string
}

export interface CodeCreateData {
  catalog_id?: string
  created_at?: string
  denomination?: number
  id?: string
  recipient_email?: string
  status?: string
}

