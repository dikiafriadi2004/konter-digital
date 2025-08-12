tailwind.config = {
    theme: {
        extend: {
            colors: {
                primary: "#2563EB",
                accent: "#16A34A",
                neutral: "#F3F4F6",
                base: "#FFFFFF",
                "text-primary": "#1E293B",
                "text-secondary": "#64748B",

                // Warna CTA (Call to Action)
                "cta-primary": "#1fbca6",
                "cta-hover": "#f89e52",

                // Warna Gradasi untuk Hero Section (diperbarui untuk kesan mewah)
                "hero-gradient-start": "#0F172A", // Biru gelap yang sangat dalam (mirip Slate 900)
                "hero-gradient-end": "#1E3A8A", // Biru tua yang kaya (mirip Blue 800)

                // Warna Footer Biru Elegan
                "footer-elegant-blue": "#192A56", // Biru navy gelap
            },
            animation: {
                scroll: "scroll 40s linear infinite",
            },
            keyframes: {
                scroll: {
                    from: { transform: "translateX(0)" },
                    to: { transform: "translateX(calc(-50% - 2rem))" },
                },
            },
        },
    },
};

// --- Script untuk Toggle Menu Mobile ---
const menuBtn = document.getElementById("menu-btn");
const menu = document.getElementById("menu");
const mobileLinks = document.querySelectorAll(".nav-link-mobile");
menuBtn.addEventListener("click", () => {
    menu.classList.toggle("hidden");
});
mobileLinks.forEach((link) => {
    link.addEventListener("click", () => {
        menu.classList.add("hidden");
    });
});

// --- Script untuk Animasi Saat Scroll ---
const scrollElements = document.querySelectorAll(".scroll-animate");
const observer = new IntersectionObserver(
    (entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add("is-visible");
            }
        });
    }, {
    threshold: 0.1
}
);
scrollElements.forEach((el) => {
    observer.observe(el);
});