import tempfile
import win32api
import win32print
GHOSTSCRIPT_PATH = "C:/laragon/www/PC-Barranquilla/python/GHOSTSCRIPT/bin/gswin32.exe"
GSPRINT_PATH = "C:/laragon/www/PC-Barranquilla/python/GSPRINT/gsprint.exe"

# YOU CAN PUT HERE THE NAME OF YOUR SPECIFIC PRINTER INSTEAD OF DEFAULT
currentprinter = win32print.GetDefaultPrinter()


dirname = 'C:/laragon/www/PC-Barranquilla/python/temp/'

filename = dirname+'form.pdf'

params = '-ghostscript "'+ GHOSTSCRIPT_PATH  +'" -printer "'+currentprinter+'" -portatil "'+filename+'"'
print(params)

win32api.ShellExecute(0, 'open', GSPRINT_PATH, params, '.',0)