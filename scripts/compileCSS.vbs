' Copyright SYRADEV - Regis TEDONE - 2023
' Compress MvcUI scss files

Dim action
action = MsgBox ("N" & chr(233) & "cessite l'installation du compilateur Sass" & vbNewLine & "C'est parti !" ,vbOKCancel,"Compression MvcUI SCSS")

if (action = vbOK) Then

    Dim finalMessage, sourceSCSS, destinationCSS, sourceFile, sourceFilenoExt, sourcefileFirstChar, command
    sourceSCSS = "../public/assets/src/SCSS/"
    destinationCSS = "../public/assets/css/"

    Set fso = CreateObject("Scripting.FileSystemObject")
    Set shell = CreateObject("WScript.Shell")
    Set scssFiles = fso.GetFolder(sourceSCSS).Files

    For Each file in scssFiles
        If LCase(fso.GetExtensionName(file)) = "scss" Then
            sourceFile = fso.GetFileName(file)
            sourceFilenoExt = Left(sourceFile, InStrRev(sourceFile, ".") - 1)
            sourcefileFirstChar = Left(sourceFile, 1)
            If (sourcefileFirstChar <> "_") And (LCase(sourceFile) <> "bootstrap.scss") Then
                command = "sass """ & file & """ """ & destinationCSS & sourceFilenoExt & ".min.css"" --style compressed"
                shell.Run command, 0, True
                finalMessage = finalMessage & sourceFilenoExt & ".min.css compression OK." & vbNewLine
            End If
        End If
    Next

    MsgBox finalMessage & "-------------------------------------", vbOKOnly, "Compression MvcUI SCSS"

    Set fso = Nothing
    Set shell = Nothing
    Set scssFiles = Nothing

End If



