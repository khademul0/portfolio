import { gsap } from 'gsap'

export function initHeroAnimation() {
    const lines = document.querySelectorAll('.hero-line')
    if (!lines.length) return

    gsap.timeline({ delay: 0.25 })
        .to(lines, { opacity: 1, y: 0, duration: 0.9, stagger: 0.12, ease: 'power3.out' })
}
