#!/bin/bash
openssl req -x509 -config hackthebox-ca.cnf -newkey rsa:4096 -sha256 -nodes -out ca.hackthebox.crt -outform PEM
