' Copyright SYRADEV - Regis TEDONE - 2023
' Compress Bootstrap scss files

Dim action
action = MsgBox ("N" & chr(233) & "cessite l'installation du compilateur Sass" & vbNewLine & "C'est parti !" ,vbOKCancel,"Compression Bootstrap CSS")

if (action = vbOK) Then
	
	Dim finalMessage, sourceBsScss, destinationBsCss, sourceFile, sourceFilenoExt, command
	sourceBsScss = "..\public\assets\src\SCSS\bootstrap.scss"
	destinationBsCss = "..\public\assets\css\bootstrap.min.css"

	sourceFile = CreateObject("Scripting.FileSystemObject").GetFileName(sourceBsScss)
	sourceFilenoExt = Left(sourceFile, InStrRev(sourceFile, ".") - 1)
	command = "sass """ & sourceBsScss & """ """ & destinationBsCss & """ --style compressed"
	CreateObject("WScript.Shell").Run command, 0, True
	finalMessage = sourceFilenoExt & ".min.css compression OK." & vbNewLine
	finalMessage =  finalMessage & "---------------------------------------------" & vbNewLine

	MsgBox finalMessage, vbOKOnly, "Compression Bootstrap CSS"

End If