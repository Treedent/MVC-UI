' Copyright SYRADEV - Regis TEDONE - 2023
' Compress All JS files in src/JS directory

Dim action
action = MsgBox ("N" & chr(233) & "cessite l'installation de node.js" & vbNewLine & "C'est parti !",vbOKCancel,"Compression JS")

if (action = vbOK) Then

  Dim finalMessage, sourceJS, destinationJS, uglify, domainUrl, fso, folder, files, file, sourceFile, sourceFilenoExt, command
  sourceJS = "../public/assets/src/JS/"
  destinationJS = "../public/assets/js/"
  uglify = "../public/assets/src/node_modules/uglify-js/bin/uglifyjs"
  domainUrl = "https://www.mvc-ui.org"

  Set fso = CreateObject("Scripting.FileSystemObject")
  Set folder = fso.GetFolder(sourceJS)
  Set files = folder.Files

  For Each file In files
    If LCase(fso.GetExtensionName(file.Path)) = "js" Then
      sourceFile = fso.GetFileName(file.Path)
      sourceFilenoExt = fso.GetBaseName(sourceFile)
      command = "node " & uglify & " """ & file.Path & """ -o """ & destinationJS & sourceFilenoExt & ".min.js"" -c -m --comments '/syradev/' --source-map ""root='" & domainUrl & "/assets/src/JS/',url='" & sourceFilenoExt & ".min.js.map'"""
      CreateObject("WScript.Shell").Run command, 0, True
      finalMessage = finalMessage & sourceFilenoExt & ".min.js compiled." & vbNewLine
    End If
  Next

  MsgBox finalMessage & "----------------------------------" , vbOKOnly, "Compression JS OK !"

  Set fso = Nothing
  Set folder = Nothing
  Set files = Nothing

End If
