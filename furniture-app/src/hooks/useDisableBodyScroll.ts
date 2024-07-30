import { useEffect } from "react"

export function useDisableBodyScroll(shouldDisable: boolean, callback: () => void) {
  useEffect(() => {
    const closeOnEscape = (event: KeyboardEvent) => {
      if (event.key === `Escape`) {
        callback()
      }
    }

    if (shouldDisable) {
      document.querySelector(`body`).style.overflow = `hidden`
      document.addEventListener(`keydown`, closeOnEscape)
    }

    return () => {
      document.querySelector(`body`).style.overflow = `auto`
      document.removeEventListener(`keydown`, closeOnEscape)
    }
  }, [shouldDisable])
}