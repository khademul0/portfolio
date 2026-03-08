import './bootstrap'

import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'
import Lenis from '@studio-freight/lenis'
import Alpine from 'alpinejs'

window.Alpine = Alpine
Alpine.start()

gsap.registerPlugin(ScrollTrigger)

document.addEventListener('DOMContentLoaded', () => {
    // Advanced GSAP ScrollTrigger Animations (Premium Feel)
    const revealElements = document.querySelectorAll('.gs-reveal')
    revealElements.forEach(el => {
        gsap.fromTo(el,
            { opacity: 0, y: 40, scale: 0.95, filter: 'blur(8px)' },
            {
                opacity: 1,
                y: 0,
                scale: 1,
                filter: 'blur(0px)',
                duration: 1.2,
                ease: 'power4.out',
                scrollTrigger: {
                    trigger: el,
                    start: 'top 85%',
                    toggleActions: 'play reverse play reverse'
                }
            }
        )
    })

    // Staggered reveals for grids (e.g. portfolio cards, skill bars)
    const staggerGroups = document.querySelectorAll('.gs-stagger-group')
    staggerGroups.forEach(group => {
        const items = group.querySelectorAll('.gs-stagger-item')
        if (!items.length) return

        gsap.fromTo(items,
            { opacity: 0, y: 30, scale: 0.95, filter: 'blur(5px)' },
            {
                opacity: 1,
                y: 0,
                scale: 1,
                filter: 'blur(0px)',
                duration: 1,
                stagger: 0.15,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: group,
                    start: 'top 85%',
                    toggleActions: 'play reverse play reverse'
                }
            }
        )
    })

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
})
