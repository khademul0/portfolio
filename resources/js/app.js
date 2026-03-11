import './bootstrap'

import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'
import Lenis from '@studio-freight/lenis'
import Alpine from 'alpinejs'

window.Alpine = Alpine
Alpine.start()

gsap.registerPlugin(ScrollTrigger)

document.addEventListener('DOMContentLoaded', () => {
    // --- 1. Hero Section Animations ---
    const heroTexts = document.querySelectorAll('.anim-hero-text')
    if(heroTexts.length) {
        gsap.fromTo(heroTexts,
            { opacity: 0, y: 30 },
            {
                opacity: 1, y: 0,
                duration: 1,
                stagger: 0.15,
                ease: 'power3.out',
                delay: 0.2
            }
        )
    }

    const heroBtns = document.querySelectorAll('.anim-hero-buttons')
    if(heroBtns.length) {
        gsap.fromTo(heroBtns,
            { opacity: 0, scale: 0.9 },
            {
                opacity: 1, scale: 1,
                duration: 0.8,
                ease: 'back.out(1.5)',
                delay: 0.8
            }
        )
    }

    const heroImg = document.querySelector('.anim-hero-image')
    if(heroImg) {
        gsap.fromTo(heroImg,
            { opacity: 0, x: 40, filter: 'blur(10px)' },
            {
                opacity: 1, x: 0, filter: 'blur(0px)',
                duration: 1.5,
                ease: 'power4.out',
                delay: 0.5
            }
        )
    }

    // --- 2. About Section: Punchy Slide-in ---
    const aboutTexts = document.querySelectorAll('.anim-about-text')
    aboutTexts.forEach(el => {
        gsap.fromTo(el,
            { opacity: 0, x: -50, filter: 'blur(5px)' },
            {
                opacity: 1, x: 0, filter: 'blur(0px)',
                duration: 1,
                ease: 'back.out(1.7)',
                scrollTrigger: {
                    trigger: el,
                    start: 'top 85%',
                    toggleActions: 'play reverse play reverse'
                }
            }
        )
    })

    const timelines = document.querySelectorAll('.anim-timeline-item')
    if(timelines.length) {
        gsap.fromTo(timelines,
            { opacity: 0, x: 30 },
            {
                opacity: 1, x: 0,
                duration: 0.8,
                stagger: 0.15,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: timelines[0].parentElement,
                    start: 'top 80%',
                    toggleActions: 'play reverse play reverse'
                }
            }
        )
    }

    // --- 3. Skills Cards: 3D Flip/Deal In ---
    const skillCards = document.querySelectorAll('.anim-skill-card')
    if(skillCards.length) {
        gsap.fromTo(skillCards,
            { opacity: 0, scale: 0.8, rotationX: 45, y: 40 },
            {
                opacity: 1, scale: 1, rotationX: 0, y: 0,
                duration: 0.8,
                stagger: 0.1,
                transformOrigin: 'top center',
                ease: 'back.out(1.7)',
                scrollTrigger: {
                    trigger: skillCards[0].parentElement,
                    start: 'top 85%',
                    toggleActions: 'play reverse play reverse'
                }
            }
        )
    }

    // --- 4. Portfolio Header & Project Cards: Sweeping Fan Up ---
    const portfolioTexts = document.querySelectorAll('.anim-portfolio-text')
    portfolioTexts.forEach(el => {
        gsap.fromTo(el,
            { opacity: 0, y: -20 },
            {
                opacity: 1, y: 0,
                duration: 0.8,
                ease: 'power2.out',
                scrollTrigger: {
                    trigger: el,
                    start: 'top 85%',
                    toggleActions: 'play reverse play reverse'
                }
            }
        )
    })

    const projectCards = document.querySelectorAll('.anim-project-card')
    if(projectCards.length) {
        gsap.fromTo(projectCards,
            { opacity: 0, y: 80, rotation: 5, scale: 0.95 },
            {
                opacity: 1, y: 0, rotation: 0, scale: 1,
                duration: 1,
                stagger: 0.15,
                ease: 'power4.out',
                scrollTrigger: {
                    trigger: projectCards[0].parentElement,
                    start: 'top 80%',
                    toggleActions: 'play reverse play reverse'
                }
            }
        )
    }

    // Lenis Smooth Scrolling Setup
    const lenis = new Lenis({
        duration: 1.2,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
        direction: 'vertical',
        gestureDirection: 'vertical',
        smooth: true,
        mouseMultiplier: 1,
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
    gsap.ticker.add((time) => { lenis.raf(time * 1000) })
    gsap.ticker.lagSmoothing(0)

    // Theme toggle buttons (support multiple e.g. mobile vs desktop)
    const btns = document.querySelectorAll('#theme-toggle, #theme-toggle-mobile')
    const root = document.documentElement
    const isDarkInitial = root.classList.contains('dark')

    btns.forEach(btn => {
        if (btn) btn.innerHTML = isDarkInitial ? '☀️ Light' : '🌙 Dark'

        btn.addEventListener('click', (e) => {
            e.preventDefault()
            const isDark = root.classList.toggle('dark')
            localStorage.setItem('theme', isDark ? 'dark' : 'light')

            // Sync all buttons
            btns.forEach(b => {
                b.innerHTML = isDark ? '☀️ Light' : '🌙 Dark'
            })

            // Small animation on the clicked one
            gsap.to(btn, {
                scale: 0.9,
                duration: 0.1,
                yoyo: true,
                repeat: 1
            })
        })
    })

    // Animate skill bars when visible
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

    // Dynamic Mouse Glow Effect (Premium soft flashlight background)
    const glow = document.createElement('div')
    glow.className = 'cursor-glow hidden md:block pointer-events-none fixed inset-0 transition-opacity duration-300'
    glow.style.zIndex = '0'
    glow.style.background = 'radial-gradient(600px circle at 50% 50%, rgba(99,102,241,0.06), transparent 40%)'
    document.body.appendChild(glow)
    
    window.addEventListener('mousemove', (e) => {
        const x = e.clientX
        const y = e.clientY
        const isDark = document.documentElement.classList.contains('dark')
        // Slightly brighter in dark mode because of contrast
        const opacity = isDark ? 0.08 : 0.04
        glow.style.background = `radial-gradient(600px circle at ${x}px ${y}px, rgba(99,102,241,${opacity}), transparent 40%)`
    })

    // Hide glow when mouse leaves window
    window.addEventListener('mouseout', (e) => {
        if (!e.relatedTarget && !e.toElement) {
            glow.style.opacity = '0'
        }
    })
    document.addEventListener('mouseenter', () => {
        glow.style.opacity = '1'
    })
})
