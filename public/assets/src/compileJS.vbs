' Copyright SYRADEV - Regis TEDONE - 2023
' Compress MvcUI js files

Dim objFSO, objShell
Set objFSO = CreateObject("Scripting.FileSystemObject")
Set objShell = WScript.CreateObject("WScript.Shell")

Dim sourceJS, destinationJS, uglify
sourceJS = ".\JS\"
destinationJS = "..\js\"
uglify = ".\node_modules\uglify-js\bin\uglifyjs"

For Each file in objFSO.GetFolder(sourceJS).Files
  If objFSO.GetExtensionName(file.Name) = "js" Then
    sourceFile = objFSO.GetFileName(file)
    sourceFilenoExt = objFSO.GetBaseName(sourceFile)
    WScript.Echo "Treating " & sourceFile & ":"
    objShell.Run uglify & " " & objFSO.GetAbsolutePathName(file) & " -o " & objFSO.BuildPath(destinationJS, sourceFilenoExt & ".min.js") & " -c -m --comments '/syradev/' --source-map ""root='https://www.mvc.org/assets/src/',url='" & sourceFilenoExt & ".min.js.map""", 0, True
    WScript.Echo sourceFile & " treated."
  End If
Next

WScript.Echo "----------------------------------"
WScript.Echo "JS Compression done!"
