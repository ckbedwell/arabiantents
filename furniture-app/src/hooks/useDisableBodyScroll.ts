import { useEffect } from "react"

export function useDisableBodyScroll(enabled: boolean, callback: () => void) {
  useEffect(() => {
    const closeOnEscape = (event: KeyboardEvent) => {
      if (event.key === `Escape`) {
        callback()
      }
    }

    if (enabled) {
      const header = document.querySelector(`.site-header`)

      if (header instanceof HTMLElement) {
        header.style.zIndex = `1`
      }

      document.querySelector(`body`).style.overflow = `hidden`
      document.addEventListener(`keydown`, closeOnEscape)
    }

    return () => {
      if (enabled) {
        const header = document.querySelector(`.site-header`)

        if (header instanceof HTMLElement) {
          header.style.zIndex = `2`
        }

        document.querySelector(`body`).style.overflow = `auto`
        document.removeEventListener(`keydown`, closeOnEscape)
      }
    }
  }, [enabled])
}
