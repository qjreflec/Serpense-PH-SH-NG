import os
import subprocess
import time
import requests
from colorama import init, Fore
from pyngrok import ngrok

init(autoreset=True)  # Renkler otomatik sıfırlansın

class serpense_otomasyon:
    def __init__(self, ngrok_token="", port=0, public_url=""):
        self.ngrok_token = ngrok_token
        self.port = port
        self.public_url = public_url

    def token_alma(self):
        print(Fore.RED + "🔐 Lütfen gerekli tokenları giriniz" + Fore.LIGHTYELLOW_EX + "!")
        self.ngrok_token = input(Fore.LIGHTCYAN_EX + "🔑 Ngrok Token > ").strip()
        self.token_dosyalari()

    def token_dosyalari(self):
        with open("ngrok_token.txt", "w") as f:
            f.write(self.ngrok_token)
            print(Fore.LIGHTGREEN_EX + "✅ Token başarıyla kaydedildi!")
            self.ngrok_baslatma()

    def dosya_kontrol(self):
        if os.path.exists("ngrok_token.txt"):
            with open("ngrok_token.txt", "r") as f:
                icrek = f.read()
            print(Fore.LIGHTGREEN_EX + "🔑 Token alındı > " + Fore.LIGHTWHITE_EX + f"{icrek}")
            self.ngrok_baslatma()
        else:
            print(Fore.RED + "❌ Token bulunamadı" + Fore.LIGHTYELLOW_EX + "!")
            self.token_alma()

    def ngrok_baslatma(self):
        self.port = input(Fore.LIGHTCYAN_EX + "🌐 Ngrok için bir port yazınız > ")
        print(Fore.RED + "⏳ NGROK başlatılıyor...")

        with open("ngrok_token.txt", "r") as f:
            ngrok_token = f.read().strip()

        ngrok.set_auth_token(ngrok_token)

        self.public_url = ngrok.connect(self.port)
        print(Fore.LIGHTGREEN_EX + "✅ Ngrok bağlantısı oluşturuldu > " + Fore.RED + f"{self.public_url}")

        link_kisalt = input(Fore.LIGHTCYAN_EX + "🔗 Ngrok linkini kısaltmak ister misin? (E/H) > ").strip().lower()
        if link_kisalt == "e":
            self.tiny()
        elif link_kisalt == "h":
            self.php_baslatma()
        else:
            print("⚠️ Lütfen sadece E ya da H yazın.")

    def tiny(self):
        while True:
            # Kullanıcıya özel isim isteği sunmadan direkt kısa link oluşturuyoruz
            print(Fore.YELLOW + "⚠️ Kısa URL oluşturuluyor, özel isim kullanılmaz.")

            # TinyURL ile linki kısaltıyoruz
            try:
                response = requests.get(f"http://tinyurl.com/api-create.php?url={self.public_url}")
                if response.status_code == 200:
                    short_url = response.text
                    print(Fore.LIGHTGREEN_EX + f"🔗 Kısa URL: {short_url}")
                    break
                else:
                    print(Fore.RED + "❌ TinyURL bağlantısı oluşturulamadı. Lütfen tekrar deneyin.")
            except Exception as e:
                print(Fore.RED + f"❗ Hata oluştu: {e}")

        self.php_baslatma()

    def php_baslatma(self):
        current_folder = os.path.dirname(os.path.abspath(__file__))
        php_path = os.path.join(current_folder, "php.exe")
        web_root = os.path.join(current_folder, "www")
        command = [php_path, "-S", f"localhost:{self.port}", "-t", web_root]

        try:
            process = subprocess.Popen(command)
            print(f"✅ PHP sunucusu başlatıldı: http://localhost:{self.port}")
            process.wait()
        except FileNotFoundError:
            print("🚫 Hata: php.exe bulunamadı. Doğru klasörde mi?")
        except PermissionError:
            print("🚫 Hata: PHP çalıştırma izni yok. Yönetici olarak dene.")
        except Exception as e:
            print(f"❗ Beklenmeyen bir hata oluştu: {e}")


srp = serpense_otomasyon()

while True:
    print(Fore.LIGHTWHITE_EX + """
✨ ** Serpense Otomasyon v1.0 ** ✨
1 >> Uygulamayı Başlat    
    """)

    kullanici = input("💻 Serpense > ")
    if kullanici == "1":
        srp.dosya_kontrol()
