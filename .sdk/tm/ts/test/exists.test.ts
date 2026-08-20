
import { test, describe } from 'node:test'
import { equal } from 'node:assert'


import { OvationincentivesSDK } from '..'


describe('exists', async () => {

  test('test-mode', async () => {
    const testsdk = await OvationincentivesSDK.test()
    equal(null !== testsdk, true)
  })

})
