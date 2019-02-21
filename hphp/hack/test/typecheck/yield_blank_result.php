<?hh // partial
/**
 * Copyright (c) 2014, Facebook, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the "hack" directory of this source tree.
 *
 *
 */

async function r(): Awaitable<int> {
  return 123;
}

async function r_nullable(): Awaitable<?int> {
  return null;
}

async function r_void(): Awaitable<void> {
  return;
}

async function rstring(): Awaitable<string> {
  return 'string';
}

async function wfr(): Awaitable<int> {
  return await r();
}

async function wfr_nullable(): Awaitable<?int> {
  return await r_nullable();
}

async function wfr_void(): Awaitable<void> {
  return await r_void();
}

async function wfvr(): Awaitable<array<int>> {
  $deps = array(wfr(), wfr(), wfr());
  return await gena($deps);
}

async function wfvr_nullable(): Awaitable<array<?int>> {
  $deps = array(wfr_nullable(), wfr_nullable(), wfr_nullable());
  return await gena($deps);
}

async function wfvr_tuple(): Awaitable<(int, int, int)> {
  $deps = tuple(wfr(), wfr(), wfr());
  return await gena($deps);
}

async function wfvr_void(): Awaitable<(int, void, int)> {
  $deps = tuple(wfr(), wfr_void(), wfr());
  return await gena($deps);
}

async function wfvrr(): Awaitable<array<array<int>>> {
  $deps = array(
    array(wfr(), wfr(), wfr()),
    array(wfr(), wfr(), wfr()),
    array(wfr(), wfr(), wfr()),
  );
  return await gen_array_rec($deps);
}

async function wfvrr_outer_tuple(): Awaitable<(array<int>, array<string>)> {
  $deps =
    tuple(array(wfr(), wfr(), wfr()), array(rstring(), rstring(), rstring()));
  return await gen_array_rec($deps);
}

async function wfvrr_inner_tuple(): Awaitable<array<(int, int, int)>> {
  $deps = array(
    tuple(wfr(), wfr(), wfr()),
    tuple(wfr(), wfr(), wfr()),
    tuple(wfr(), wfr(), wfr()),
  );
  return await gen_array_rec($deps);
}

async function wfvrr_deep(
): Awaitable<array<array<(int, array<string>, int)>>> {
  $deps = array(array(tuple(r(), array(rstring(), rstring()), r())));
  return await gen_array_rec($deps);
}
