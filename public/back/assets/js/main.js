// Konfigurasi Kustom Tailwind CSS
tailwind.config = {
    darkMode: "class",
    theme: {
        extend: {
            colors: {
                primary: {
                    50: "#eff6ff",
                    100: "#dbeafe",
                    200: "#bfdbfe",
                    300: "#93c5fd",
                    400: "#60a5fa",
                    500: "#3b82f6",
                    600: "#2563eb",
                    700: "#1d4ed8",
                    800: "#1e40af",
                    900: "#1e3a8a",
                },
                success: { // Define success color for notification
                    500: '#22c55e', // green-500
                    600: '#16a34a'  // green-600
                },
                danger: { // Define danger color for notification (for potential error notifications)
                    500: '#ef4444', // red-500
                    600: '#dc2626'  // red-600
                }
            },
        },
    },
};


document.addEventListener('DOMContentLoaded', () => {
    // --- Inisialisasi Chart.js ---
    const ctx = document.getElementById('analyticsChart');
    if (ctx) {
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul'],
                datasets: [{
                    label: 'Tampilan Halaman',
                    data: [65, 59, 80, 81, 56, 55, 40],
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }, {
                    label: 'Pengunjung Unik',
                    data: [30, 40, 45, 50, 60, 70, 65],
                    fill: false,
                    borderColor: 'rgb(153, 102, 255)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            color: 'rgb(100, 116, 139)' // text-slate-500
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: 'rgb(100, 116, 139)'
                        },
                        grid: {
                            color: 'rgba(203, 213, 225, 0.2)' // slate-300 with transparency
                        }
                    },
                    y: {
                        ticks: {
                            color: 'rgb(100, 116, 139)'
                        },
                        grid: {
                            color: 'rgba(203, 213, 225, 0.2)'
                        }
                    }
                }
            }
        });
    }

    // Sidebar and Dark Mode Toggle Logic (Copied from global.js if it exists)
    const sidebarToggleMobile = document.getElementById('sidebar-toggle-mobile');
    const sidebar = document.getElementById('sidebar');
    const sidebarBackdrop = document.getElementById('sidebar-backdrop');
    const darkModeToggle = document.getElementById('dark-mode-toggle');
    const sunIcon = document.getElementById('sun-icon');
    const moonIcon = document.getElementById('moon-icon');
    const htmlTag = document.documentElement;

    // Toggle sidebar for mobile
    if (sidebarToggleMobile && sidebar && sidebarBackdrop) {
        sidebarToggleMobile.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            sidebarBackdrop.classList.toggle('hidden');
        });
        sidebarBackdrop.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            sidebarBackdrop.classList.add('hidden');
        });
    }

    // Dark Mode Toggle functionality
    const currentTheme = localStorage.getItem('theme');
    if (currentTheme === 'dark' || (!currentTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        htmlTag.classList.add('dark');
        sunIcon.classList.add('hidden');
        moonIcon.classList.remove('hidden');
    } else {
        htmlTag.classList.remove('dark');
        sunIcon.classList.remove('hidden');
        moonIcon.classList.add('hidden');
    }

    if (darkModeToggle) {
        darkModeToggle.addEventListener('click', () => {
            htmlTag.classList.toggle('dark');
            if (htmlTag.classList.contains('dark')) {
                localStorage.setItem('theme', 'dark');
                sunIcon.classList.add('hidden');
                moonIcon.classList.remove('hidden');
            } else {
                localStorage.setItem('theme', 'light');
                sunIcon.classList.remove('hidden');
                moonIcon.classList.add('hidden');
            }
        });
    }

    // User menu dropdown logic
    const userMenuButton = document.getElementById('user-menu-button');
    const userMenu = document.getElementById('user-menu');

    if (userMenuButton && userMenu) {
        userMenuButton.addEventListener('click', () => {
            userMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', (event) => {
            if (!userMenuButton.contains(event.target) && !userMenu.contains(event.target)) {
                userMenu.classList.add('hidden');
            }
        });
    }

    // Submenu Toggle Logic
    const submenuToggle = document.getElementById('submenu-toggle');
    const submenu = document.getElementById('submenu');
    const submenuArrow = document.getElementById('submenu-arrow');

    if (submenuToggle && submenu && submenuArrow) {
        submenuToggle.addEventListener('click', () => {
            submenu.classList.toggle('hidden');
            submenuArrow.classList.toggle('rotate-180');
            // Remove active class from toggle when manually closed
            if (submenu.classList.contains('hidden')) {
                submenuToggle.classList.remove('active');
                submenuToggle.classList.remove('text-primary-600', 'bg-slate-100', 'border-l-primary-500');
                submenuToggle.classList.remove('dark:text-primary-400', 'dark:bg-slate-700', 'dark:border-l-primary-500');
            }
        });
    }

    // Active Nav Link Logic (Laravel Compatible)
    const navLinks = document.querySelectorAll('.nav-link');
    const currentPath = window.location.pathname; // misalnya "/cms/posts/create"

    let isSubmenuPageActive = false;
    let matchedLink = null;
    let longestMatchLength = 0;

    // Cari link yang paling cocok (path terpanjang)
    navLinks.forEach(link => {
        const linkPath = link.pathname;

        if (
            (linkPath === "/" && currentPath === "/") ||
            (linkPath !== "/" && currentPath.startsWith(linkPath))
        ) {
            // ambil yang match terpanjang
            if (linkPath.length > longestMatchLength) {
                longestMatchLength = linkPath.length;
                matchedLink = link;
            }
        }
    });

    // Reset semua link dulu
    navLinks.forEach(link => {
        link.classList.remove(
            'active',
            'text-primary-600',
            'bg-slate-100',
            'border-l-primary-500',
            'dark:text-primary-400',
            'dark:bg-slate-700',
            'dark:border-l-primary-500'
        );
    });

    // Tandai hanya link yang match terpanjang
    if (matchedLink) {
        matchedLink.classList.add(
            'active',
            'text-primary-600',
            'bg-slate-100',
            'border-l-primary-500',
            'dark:text-primary-400',
            'dark:bg-slate-700',
            'dark:border-l-primary-500'
        );

        // kalau link yang aktif adalah submenu
        if (matchedLink.classList.contains('submenu-link')) {
            isSubmenuPageActive = true;
        }
    }

    // Handle submenu toggle
    if (submenuToggle && submenu && submenuArrow) {
        if (isSubmenuPageActive) {
            submenuToggle.classList.add(
                'active',
                'text-primary-600',
                'bg-slate-100',
                'border-l-primary-500',
                'dark:text-primary-400',
                'dark:bg-slate-700',
                'dark:border-l-primary-500'
            );
            submenu.classList.remove('hidden');
            submenuArrow.classList.add('rotate-180');
        } else {
            submenuToggle.classList.remove(
                'active',
                'text-primary-600',
                'bg-slate-100',
                'border-l-primary-500',
                'dark:text-primary-400',
                'dark:bg-slate-700',
                'dark:border-l-primary-500'
            );
            submenu.classList.add('hidden');
            submenuArrow.classList.remove('rotate-180');
        }
    }

    function closeFlashModal() {
        const modal = document.getElementById('flashModal');
        if (modal) {
            modal.firstElementChild.classList.remove('animate-fade-in');
            modal.firstElementChild.classList.add('animate-fade-out');
            setTimeout(() => modal.style.display = 'none', 300); // tunggu animasi selesai
        }
    }

    // tombol manual close
    document.getElementById('closeFlashModal')?.addEventListener('click', closeFlashModal);

    // auto close 3 detik
    if (document.getElementById('flashModal')) {
        setTimeout(closeFlashModal, 3000);
    }
});