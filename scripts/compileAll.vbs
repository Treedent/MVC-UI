' Copyright SYRADEV - Regis TEDONE - 2023
' Compress BS-CSS-JS and Update Documentation

Dim objShell
Set objShell = Wscript.CreateObject("WScript.Shell")

objShell.Run ".\compileBS.vbs"
objShell.Run ".\compileCSS.vbs"
objShell.Run ".\compileJS.vbs"
objShell.Run ".\genPHPDoc.vbs"

