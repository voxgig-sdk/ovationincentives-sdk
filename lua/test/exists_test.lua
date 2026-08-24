-- Ovationincentives SDK exists test

local sdk = require("ovationincentives_sdk")

describe("OvationincentivesSDK", function()
  it("should create test SDK", function()
    local testsdk = sdk.test(nil, nil)
    assert.is_not_nil(testsdk)
  end)
end)
