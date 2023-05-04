#!/bin/bash
# Copyright SYRADEV - Regis TEDONE - 2023
# Compress Bootstrap scss files

declare sourceBsScss="../public/assets/src/SCSS/bootstrap.scss"
declare destinationBsCss="../public/assets/css/bootstrap.min.css"

sourceFile=$(basename "$sourceBsScss")
sourceFilenoExt="${sourceFile%%.*}"
echo Treating "$sourceFile":
sass "$sourceBsScss" "$destinationBsCss" --style compressed
echo "$sourceFilenoExt".min.css compressed.
echo -------------------------------------
echo SCSS Compilation done!
