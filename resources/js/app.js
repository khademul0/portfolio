import './bootstrap'

import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'
import Lenis from '@studio-freight/lenis'
import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm'
import Collapse from '@alpinejs/collapse'

Alpine.plugin(Collapse)
Livewire.start()

gsap.registerPlugin(ScrollTrigger)

document.addEventListener('DOMContentLoaded', () => {

    // ─── GSAP: Set initial hidden state for animated elements via JS ───
    // (NOT via HTML opacity-0 class, so content stays visible if JS fails)

    // --- 1. Hero Section Animations ---
    const heroTexts = document.querySelectorAll('.anim-hero-text')
    if (heroTexts.length) {
        gsap.set(heroTexts, { opacity: 0, y: 30 })
        gsap.to(heroTexts, {
            opacity: 1, y: 0,
            duration: 1,
            stagger: 0.15,
            ease: 'power3.out',
            delay: 0.2
        })
    }

    const heroBtns = document.querySelectorAll('.anim-hero-buttons')
    if (heroBtns.length) {
        gsap.set(heroBtns, { opacity: 0, scale: 0.9 })
        gsap.to(heroBtns, {
            opacity: 1, scale: 1,
            duration: 0.8,
            ease: 'back.out(1.5)',
            delay: 0.8
        })
    }

    const heroImg = document.querySelector('.anim-hero-image')
    if (heroImg) {
        gsap.set(heroImg, { opacity: 0, x: 40 })
        gsap.to(heroImg, {
            opacity: 1, x: 0,
            duration: 1.5,
            ease: 'power4.out',
            delay: 0.5
        })
    }

    // --- 2. About Section: Punchy Slide-in ---
    const aboutTexts = document.querySelectorAll('.anim-about-text')
    if (aboutTexts.length) {
        gsap.set(aboutTexts, { opacity: 0, x: -50 })
        aboutTexts.forEach(el => {
            gsap.to(el, {
                opacity: 1, x: 0,
                duration: 1,
                ease: 'back.out(1.7)',
                scrollTrigger: {
                    trigger: el,
                    start: 'top 85%',
                    toggleActions: 'play none none reverse'
                }
            })
        })
    }

    const timelines = document.querySelectorAll('.anim-timeline-item')
    if (timelines.length) {
        gsap.set(timelines, { opacity: 0, x: 30 })
        gsap.to(timelines, {
            opacity: 1, x: 0,
            duration: 0.8,
            stagger: 0.15,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: timelines[0].parentElement,
                start: 'top 80%',
                toggleActions: 'play none none reverse'
            }
        })
    }

    // --- 3. Skills Cards: 3D Flip/Deal In ---
    const skillCards = document.querySelectorAll('.anim-skill-card')
    if (skillCards.length) {
        gsap.set(skillCards, { opacity: 0, scale: 0.85, y: 40 })
        gsap.to(skillCards, {
            opacity: 1, scale: 1, y: 0,
            duration: 0.7,
            stagger: 0.08,
            ease: 'back.out(1.5)',
            scrollTrigger: {
                trigger: skillCards[0].parentElement,
                start: 'top 85%',
                toggleActions: 'play none none reverse'
            }
        })
    }

    // --- 4. Portfolio Header & Project Cards: Sweeping Fan Up ---
    const portfolioTexts = document.querySelectorAll('.anim-portfolio-text')
    if (portfolioTexts.length) {
        gsap.set(portfolioTexts, { opacity: 0, y: -20 })
        portfolioTexts.forEach(el => {
            gsap.to(el, {
                opacity: 1, y: 0,
                duration: 0.8,
                ease: 'power2.out',
                scrollTrigger: {
                    trigger: el,
                    start: 'top 85%',
                    toggleActions: 'play none none reverse'
                }
            })
        })
    }

    const projectCards = document.querySelectorAll('.anim-project-card')
    if (projectCards.length) {
        gsap.set(projectCards, { opacity: 0, y: 60, scale: 0.95 })
        gsap.to(projectCards, {
            opacity: 1, y: 0, scale: 1,
            duration: 0.9,
            stagger: 0.12,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: projectCards[0].parentElement,
                start: 'top 80%',
                toggleActions: 'play none none reverse'
            }
        })
    }

    // ─── Lenis Smooth Scrolling ───────────────────────────────────────────
    try {
        const lenis = new Lenis({
            duration: 1.2,
            easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
            smoothTouch: false,
            touchMultiplier: 2,
        })

        function raf(time) {
            lenis.raf(time)
            requestAnimationFrame(raf)
        }
        requestAnimationFrame(raf)

        // Sync GSAP ScrollTrigger with Lenis
        lenis.on('scroll', ScrollTrigger.update)
        gsap.ticker.lagSmoothing(0)

    } catch (e) {
        // Lenis failed (e.g. unsupported browser) — ScrollTrigger still works via native scroll
        console.warn('Lenis init failed, falling back to native scroll:', e)
        ScrollTrigger.refresh()
    }

    // ─── Theme Toggle ──────────────────────────────────────────────────────
    const btns = document.querySelectorAll('#theme-toggle, #theme-toggle-mobile')
    const root = document.documentElement
    const isDarkInitial = root.classList.contains('dark')

    btns.forEach(btn => {
        if (btn) btn.innerHTML = isDarkInitial ? '☀️ Light' : '🌙 Dark'

        btn.addEventListener('click', (e) => {
            e.preventDefault()
            const isDark = root.classList.toggle('dark')
            localStorage.setItem('theme', isDark ? 'dark' : 'light')

            btns.forEach(b => {
                b.innerHTML = isDark ? '☀️ Light' : '🌙 Dark'
            })

            gsap.to(btn, {
                scale: 0.9,
                duration: 0.1,
                yoyo: true,
                repeat: 1
            })
        })
    })

    // ─── Skill Bars ────────────────────────────────────────────────────────
    const bars = document.querySelectorAll('.skill-bar')
    if (bars.length) {
        const io = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (!e.isIntersecting) return
                const el = e.target
                const level = el.getAttribute('data-level') || 0
                el.style.transition = 'width 900ms cubic-bezier(.2,.8,.2,1)'
                el.style.width = `${level}%`
                io.unobserve(el)
            })
        }, { threshold: 0.35 })

        bars.forEach(b => io.observe(b))
    }

    // ─── Mouse Glow Effect ─────────────────────────────────────────────────
    const glow = document.createElement('div')
    glow.className = 'cursor-glow hidden md:block pointer-events-none fixed inset-0 transition-opacity duration-300'
    glow.style.zIndex = '0'
    glow.style.background = 'radial-gradient(600px circle at 50% 50%, rgba(99,102,241,0.06), transparent 40%)'
    document.body.appendChild(glow)

    window.addEventListener('mousemove', (e) => {
        const isDark = document.documentElement.classList.contains('dark')
        const opacity = isDark ? 0.08 : 0.04
        glow.style.background = `radial-gradient(600px circle at ${e.clientX}px ${e.clientY}px, rgba(99,102,241,${opacity}), transparent 40%)`
    })

    window.addEventListener('mouseout', (e) => {
        if (!e.relatedTarget && !e.toElement) glow.style.opacity = '0'
    })
    document.addEventListener('mouseenter', () => {
        glow.style.opacity = '1'
    })
})
