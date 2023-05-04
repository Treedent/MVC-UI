' Copyright SYRADEV - Regis TEDONE - 2023
' Génère la documentation PHPDoc


Dim action
action = MsgBox ("C'est parti !" ,vbOKCancel,"G" & chr(233) &"n" & chr(233) &"ration documentation PhpDoc")

if (action = vbOK) Then

	Dim rootPath, phpdocPath, sourcePath, targetPath, command
	rootPath = "C:\xampp\localsites\MVC-UI"
	phpdocPath = ".\phpDocumentor.phar"
	sourcePath = rootPath
	targetPath = "..\public\documentation"

	Set shell = CreateObject("WScript.Shell")
	command = "php """ & phpdocPath & """ run -d """ & sourcePath & """ -t """ & targetPath & """"
	shell.Run command, 1, True
	MsgBox "G" & chr(233) &"n" & chr(233) &"ration documentation PhpDoc OK",vbOKOnly, "PHPDoc"

	Set shell = Nothing
End If


	
