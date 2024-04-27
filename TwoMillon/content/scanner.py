#!/usr/bin/env python3

from pwn import *
from termcolor import colored
from scapy.all import *

import signal
import sys
import time
import logging
import threading

logging.getLogger("scapy.runtime").setLevel(logging.ERROR)

def def_handler(sig, frame):
    print(colored(f"\n\n[!] Exiting...\n ", 'red'))
    p1.failure("Scan aborted")
    sys.exit(1)

# CTRL + C
signal.signal(signal.SIGINT, def_handler)

p1 = log.progress("TCP Scan")
p1.status("Scaning ports...")

def scanPort(ip, port):
    src_port = RandShort()
    try:
        response = sr1(IP(dst=ip)/TCP(sport=src_port, dport=port, flags="S"), timeout=2, verbose=0)
        if response is None:    
            return False
        elif response.haslayer(TCP) and response.getlayer(TCP).flags == 0x12:
            send(IP(dst=ip)/TCP(sport=src_port, dport=port, flags="R"), verbose=0) #reset packet
            return True
        else:
            return False
    except Exception as e:
        log.failure(f"Error scanning {ip} on port {port}: {e}")
        sys.exit(1)

def thread_func(ip, port):
    response = scanPort(ip, port)
    if response:
        log.info(f"Port {port} - OPEN in {ip}") 

def main(ip, ports, endPort):
    threads = []
    time.sleep(2)

    for port in ports:
        p1.status(f"Scan progress: [{port}/{endPort}]")

        thread = threading.Thread(target=thread_func, args=(ip,port))
        thread.start()
        threads.append(thread)

    for thread in threads:
        thread.join()

    p1.success("Scan completed")

if __name__ == '__main__':
    if len(sys.argv) != 3:
        print(colored(f" [!] Use: {colored('python3','blue')} {colored(sys.argv[0],'green')} {colored('<ip> <port-range>','yellow')}", 'red'))
        sys.exit(1)
    
    targetIp = sys.argv[1]
    portRange = sys.argv[2].split("-")
    startPort = int(portRange[0])
    endPort = int(portRange[1])

    ports = range(startPort,endPort+1)
    main(targetIp, ports, endPort)