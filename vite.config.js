import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite'
import tailwindcss from 'tailwindcss'
import autoprefixer from 'autoprefixer'

// Konfigurasi Tailwind langsung di sini
const tailwindConfig = {
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

                // Warna Gradasi untuk Hero Section
                "hero-gradient-start": "#0F172A", // Biru gelap yang sangat dalam
                "hero-gradient-end": "#1E3A8A",   // Biru tua yang kaya

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
}

export default defineConfig({
    css: {
        postcss: {
            plugins: [
                tailwindcss(tailwindConfig),
                autoprefixer()
            ]
        }
    }
})
