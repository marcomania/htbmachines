#!/usr/bin/env python3

def rot_13(text):
    result = ""
    for char in text:
        if char.isalpha():  # Solo cifra letras
            offset = 65 if char.isupper() else 97
            result += chr((ord(char) - offset + 13) % 26 + offset)
        else:
            result += char
    return result

# Función para leer el texto encriptado desde un archivo
def read_encrypted_text_from_file(file_path):
    with open(file_path, 'r') as file:
        encrypted_text = file.read().strip()  # Lee el texto y elimina cualquier espacio en blanco adicional
    return encrypted_text

# Ruta del archivo que contiene el texto encriptado
file_path = 'encrypted_text.txt'

# Lee el texto encriptado desde el archivo
encrypted_text = read_encrypted_text_from_file(file_path)

# Desencripta el texto
decrypted_text = rot_13(encrypted_text)

# Imprime el texto desencriptado
print('Encrypted text:\n', encrypted_text)
print('Decrypted text:\n', decrypted_text)