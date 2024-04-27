import asyncore
from smtpd import SMTPServer

class CustomSMTPServer(SMTPServer):
    def process_message(self, peer, mailfrom, rcpttos, data):
        print(f"Recibido mensaje de: {mailfrom}")
        print(f"Destinatarios: {rcpttos}")
        print(f"Cuerpo del mensaje:\n{data}\n")

# Especifica la dirección IP y el puerto en los que deseas escuchar.
ip = '10.10.11.212'
port = 25

# Crea una instancia del servidor SMTP personalizado y ejecútalo.
print(f"Iniciando el servidor SMTP en {ip}:{port}...")
server = CustomSMTPServer((ip, port), None)
asyncore.loop()