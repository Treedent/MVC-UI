#!/bin/bash
# Copyright SYRADEV - Regis TEDONE - 2023
# Compress MvcUI js files

declare sourceJS="../public/assets/src/JS/"
declare destinationJS="../public/assets/js/"
declare uglify="../public/assets/src/node_modules/uglify-js/bin/uglifyjs"
declare domainUrl="https://www.mvc-ui.org"

for file in "$sourceJS"*.js; do
  sourceFile=$(basename "$file")
  sourceFilenoExt="${sourceFile%.*}"
  echo Treating "$sourceFile":
  $uglify "$file" -o $destinationJS"$sourceFilenoExt".min.js -c -m --comments '/syradev/' --source-map "root='"$domainUrl"/assets/src/JS/',url='$sourceFilenoExt.min.js.map'"
  echo "$sourceFilenoExt".min.js compiled.
  echo ----------------------------------
done
echo JS Compression done!
