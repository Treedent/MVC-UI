' Copyright SYRADEV - Regis TEDONE - 2023
' Compress MvcUI scss files

Dim objFSO, objShell
Set objFSO = CreateObject("Scripting.FileSystemObject")
Set objShell = WScript.CreateObject("WScript.Shell")

Dim sourceSCSS, destinationCSS
sourceSCSS = ".\SCSS\"
destinationCSS = "..\css\"

For Each file in objFSO.GetFolder(sourceSCSS).Files
  If objFSO.GetExtensionName(file.Name) = "scss" Then
    sourceFile = objFSO.GetFileName(file)
    sourceFilenoExt = objFSO.GetBaseName(sourceFile)
    sourcefileFirstChar = Left(sourceFile, 1)
    If sourcefileFirstChar <> "_" Then
      WScript.Echo "Treating " & sourceFile & ":"
      objShell.Run "cmd /c sass " & objFSO.GetAbsolutePathName(file) & " " & objFSO.BuildPath(destinationCSS, sourceFilenoExt & ".min.css") & " --style compressed", 0, True
      WScript.Echo sourceFile & " treated."
    End If
  End If
Next

WScript.Echo "-------------------------------------"
WScript.Echo "SCSS Compilation done!"
