<?hh
// Copyright (c) Facebook, Inc. and its affiliates. All Rights Reserved.

<<file:__EnableUnstableFeatures(
  'enum_supertyping',
)>>

class C {}

enum E : int includes C {
  A = 1;
}

<<__EntryPoint>>
function main() : void {
  echo E::A . "\n";
}
