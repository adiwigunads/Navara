document.addEventListener('DOMContentLoaded', () => {
    const hero = document.getElementById('hero-carousel');

    if (hero) {
        const slides = JSON.parse(hero.dataset.slides || '[]');
        const bg = document.getElementById('hero-bg');
        const title = document.getElementById('hero-slide-title');
        const lokasi = document.getElementById('hero-slide-lokasi');
        const deskripsi = document.getElementById('hero-slide-deskripsi');
        const indicators = hero.querySelectorAll('[data-slide-index]');
        let current = 0;
        let timer;

        const setSlide = (index) => {
            if (!slides.length) {
                return;
            }

            current = index;
            const slide = slides[current];

            if (bg && slide?.gambar) {
                bg.style.backgroundImage = `url('${slide.gambar}')`;
            }

            if (title) {
                title.textContent = slide?.nama ?? '';
            }

            if (lokasi) {
                lokasi.textContent = slide?.lokasi ?? '';
            }

            if (deskripsi) {
                deskripsi.textContent = slide?.deskripsi ?? '';
            }

            indicators.forEach((el) => {
                const i = Number(el.dataset.slideIndex);
                const active = i === current;
                el.classList.toggle('bg-white/15', active);
                el.classList.toggle('font-bold', active);
                el.classList.toggle('text-white', active);
                el.classList.toggle('text-white/50', !active);
                el.querySelector('[data-indicator-line]')?.classList.toggle('hidden', !active);
            });
        };

        const next = () => setSlide((current + 1) % slides.length);

        indicators.forEach((el) => {
            el.addEventListener('click', () => {
                clearInterval(timer);
                setSlide(Number(el.dataset.slideIndex));
                timer = setInterval(next, 6000);
            });
        });

        setSlide(0);
        timer = setInterval(next, 6000);
    }

    const navToggle = document.getElementById('nav-toggle');
    const navMenu = document.getElementById('nav-menu');

    navToggle?.addEventListener('click', () => {
        navMenu?.classList.toggle('hidden');
    });

    navMenu?.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => {
            navMenu.classList.add('hidden');
        });
    });
});
