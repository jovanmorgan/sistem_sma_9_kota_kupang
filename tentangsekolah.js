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

const profileImg = document.getElementById("profile-img");

profileImg.addEventListener("mouseenter", () => {
    profileImg.style.boxShadow = "0px 8px 16px rgba(0, 0, 0, 0.3)";
});

profileImg.addEventListener("mouseleave", () => {
    profileImg.style.boxShadow = "none";
});

document.addEventListener("DOMContentLoaded", function() {
    // Fungsi ini akan dipanggil saat halaman selesai dimuat
    // Di sini Anda dapat menambahkan kode untuk memulai animasi jika diperlukan

    // Memilih elemen yang ingin dianimasikan
    var garisTitik = document.querySelector(".garistitik");
    var leftContent = document.querySelector(".center-content");

    // Memulai animasi ketika halaman selesai dimuat
    garisTitik.classList.add("animate");
    centerContent.classList.add("animate");
});