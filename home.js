/**NAVBAR SHADOW*/
document.addEventListener("DOMContentLoaded", function() {
    var mainHeader = document.getElementById("navbar");
    var prevScrollPos = window.pageYOffset;
    var isNavbarShadowAdded = false;

    window.addEventListener("scroll", function() {
        var currentScrollPos = window.pageYOffset;
        if (
            currentScrollPos > 0 &&
            currentScrollPos > prevScrollPos &&
            !isNavbarShadowAdded
        ) {
            mainHeader.classList.add("navbar-shadow");
            isNavbarShadowAdded = true;
        } else if (currentScrollPos === 0 && isNavbarShadowAdded) {
            mainHeader.classList.remove("navbar-shadow");
            isNavbarShadowAdded = false;
        }
        prevScrollPos = currentScrollPos;
    });
});

/**KONTEN KE 1  */
// Ambil elemen hero-section
var heroSection = document.querySelector(".hero-section");

// Buat fungsi untuk menetapkan tinggi lapisan overlay
function setOverlayHeight() {
    var bgImage = new Image();
    bgImage.src = heroSection.style.backgroundImage.replace(
        /url\((['"])?(.*?)\1\)/gi,
        "$2"
    );
    bgImage.onload = function() {
        var overlayHeight = bgImage.height;
        heroSection.style.height = overlayHeight + "px";
        heroSection.style.position = "relative";
        heroSection.style.overflow = "hidden";
    };
}

// Panggil fungsi untuk menetapkan tinggi lapisan overlay saat halaman dimuat
window.onload = setOverlayHeight;

//SCROLING PADA KONTEN 2
// Fungsi untuk melakukan scrolling dengan kecepatan lambat
function slowScroll() {
    const destination = document.querySelector("#konten2").offsetTop; // Ambil posisi vertikal dari konten ke-2
    const initialPosition = window.pageYOffset; // Ambil posisi vertikal awal dari halaman
    const distance = destination - initialPosition; // Hitung jarak yang perlu di-scroll

    // Menggunakan requestAnimationFrame untuk animasi yang lebih smooth
    function scrollAnimation(currentTime) {
        const timeElapsed = currentTime - startTime; // Hitung waktu yang telah berlalu
        const run = ease(timeElapsed, initialPosition, distance, duration); // Hitung posisi yang akan di-scroll
        window.scrollTo(0, run); // Lakukan scrolling

        if (timeElapsed < duration) {
            requestAnimationFrame(scrollAnimation); // Jika waktu belum habis, lanjutkan animasi
        }
    }

    // Fungsi ease untuk membuat efek lambat
    function ease(t, b, c, d) {
        t /= d / 2;
        if (t < 1) return (c / 2) * t * t + b;
        t--;
        return (-c / 2) * (t * (t - 2) - 1) + b;
    }

    const duration = 1000; // Durasi animasi dalam milidetik
    const startTime = performance.now(); // Waktu mulai animasi
    requestAnimationFrame(scrollAnimation); // Panggil fungsi animasi scrolling
}

// Jalankan fungsi slowScroll setelah 7 detik
/**setTimeout(slowScroll, 10000); // 10000 milidetik = 10 detik **/


/** KALENDER */
// Fungsi untuk membuat kalender
function createCalendar() {
    const date = new Date(); // Mendapatkan tanggal saat ini
    const options = {
        weekday: "long",
        year: "numeric",
        month: "long",
        day: "numeric",
    };
    const formattedDate = date.toLocaleDateString("id-ID", options); // Format tanggal dengan bahasa Indonesia

    const calendarElement = document.getElementById("calendar");
    calendarElement.innerHTML = `<h3>Kalender</h3><p>${formattedDate}</p>`; // Menambahkan tanggal ke dalam elemen kalender
}

// Panggil fungsi createCalendar untuk membuat kalender saat halaman dimuat
createCalendar();
/**KONTEN KE 2 IMG */
// Panggil fungsi createCalendar untuk membuat kalender
createCalendar();

const profileImg = document.getElementById("profile-img");

profileImg.addEventListener("mouseenter", () => {
    profileImg.style.boxShadow = "0px 8px 16px rgba(0, 0, 0, 0.3)";
});

profileImg.addEventListener("mouseleave", () => {
    profileImg.style.boxShadow = "none";
});