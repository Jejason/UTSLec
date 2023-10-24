function filterSelection(category) {
    var categories = document.querySelectorAll(".category-container");
    if (category === 'all') {
        categories.forEach(function(cat) {
            cat.style.display = "block";
        });
    } else {
        categories.forEach(function(cat) {
            cat.style.display = "none";
        });
        var selectedCategory = document.getElementById(category);
        if (selectedCategory) {
            selectedCategory.style.display = "block";
        }
    }
}

document.addEventListener("DOMContentLoaded", function() {
    filterSelection("all"); 
    const filterButtons = document.querySelectorAll(".filter-btn");
    filterButtons.forEach(function(button) {
        button.addEventListener("click", function() {
            const activeButton = document.querySelector(".filter-btn.active");
            activeButton.classList.remove("active");
            button.classList.add("active");
            filterSelection(button.getAttribute("data-filter"));
        });
    });
});

document.addEventListener("DOMContentLoaded", function() {
    filterSelection("all"); 
    const filterButtons = document.querySelectorAll(".filter-btn");
    filterButtons.forEach(function(button) {
        button.addEventListener("click", function() {
            const activeButton = document.querySelector(".filter-btn.active");
            activeButton.classList.remove("active");
            button.classList.add("active");
            filterSelection(button.getAttribute("data-filter"));
        });
    });

    const cardContainers = document.querySelectorAll(".category-container");
    cardContainers.forEach(function(container) {
        const cards = container.querySelectorAll(".card");
        cards.forEach(function(card) {
            // Mendapatkan daftar kelas CSS yang ada di CSS Anda
            const colorClasses = ["bg-color-1", "bg-color-2", "bg-color-3","bg-color-4", "bg-color-5"]; // Tambahkan sesuai dengan yang Anda miliki
            
            // Memilih kelas warna secara acak
            const randomColorClass = colorClasses[Math.floor(Math.random() * colorClasses.length)];

            // Menambahkan kelas warna secara acak ke kartu
            card.classList.add(randomColorClass);
        });
    });
});

$(document).ready(function() {
    $(".btn").click(function() {
        $(".btn").removeClass("active"); // Hapus class active dari semua tombol
        $(this).addClass("active"); // Tambahkan class active ke tombol yang diklik
    });
});
// tambahan jason//
