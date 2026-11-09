// -> Header beim Runterscrollen ausblenden, beim Hochscrollen wieder zeigen
const header = document.querySelector('[data-layout="header"]');
if (header) {
    let lastY = window.scrollY;
    const onScroll = () => {
        const y = window.scrollY;
        header.classList.toggle('is-scrolled', y > 40);
        header.classList.toggle('is-hidden', y > lastY && y > 200);
        lastY = y;
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
}

// -> Vorschau-Loops in der Projektübersicht: erst beim Hover laden und abspielen
const canHover = window.matchMedia('(hover: hover)').matches;
document.querySelectorAll('[data-teaser="project"]').forEach((teaser) => {
    const video = teaser.querySelector('video[data-src]');
    if (!video) return;

    // Auf Touch-Geräten: Loop automatisch abspielen, sobald der Teaser sichtbar ist
    if (!canHover) {
        new IntersectionObserver(([entry]) => {
            if (entry.isIntersecting) {
                if (!video.src) video.src = video.dataset.src;
                video.play().then(() => video.classList.add('is-playing')).catch(() => {});
                video.style.opacity = 1;
            } else {
                video.pause();
            }
        }, { threshold: 0.6 }).observe(teaser);
        return;
    }

    teaser.addEventListener('mouseenter', () => {
        if (!video.src) video.src = video.dataset.src;
        video.play().then(() => video.classList.add('is-playing')).catch(() => {});
    });
    teaser.addEventListener('mouseleave', () => {
        video.pause();
        video.classList.remove('is-playing');
    });
});

// -> YouTube erst nach Klick laden (keine Verbindung zu Google vor dem Abspielen)
document.querySelectorAll('[data-youtube]').forEach((button) => {
    button.addEventListener('click', () => {
        const iframe = document.createElement('iframe');
        iframe.src = `https://www.youtube-nocookie.com/embed/${button.dataset.youtube}?autoplay=1&rel=0&modestbranding=1&playsinline=1`;
        iframe.title = button.getAttribute('aria-label') || 'Video';
        iframe.allow = 'autoplay; fullscreen; picture-in-picture; encrypted-media';
        iframe.allowFullscreen = true;

        const wrapper = document.createElement('div');
        wrapper.className = 'video_facade';
        wrapper.appendChild(iframe);
        button.replaceWith(wrapper);
    });
});
