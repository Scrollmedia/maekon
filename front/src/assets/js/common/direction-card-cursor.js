const OFFSET_X = 18
const OFFSET_Y = 18

export function initDirectionCardCursor() {
    if (!window.matchMedia('(pointer: fine)').matches) return

    const cards = [...document.querySelectorAll('.direction-card')]
    if (!cards.length) return

    const badge = document.createElement('div')
    badge.className = 'direction-card-cursor-badge'
    badge.textContent = 'Смотреть'
    document.body.appendChild(badge)

    const moveBadge = (event) => {
        badge.style.transform = `translate(${event.clientX + OFFSET_X}px, ${event.clientY + OFFSET_Y}px)`
    }

    const showBadge = () => {
        badge.classList.add('is-visible')
    }

    const hideBadge = () => {
        badge.classList.remove('is-visible')
    }

    cards.forEach((card) => {
        card.addEventListener('mouseenter', showBadge)
        card.addEventListener('mousemove', moveBadge)
        card.addEventListener('mouseleave', hideBadge)
    })
}
