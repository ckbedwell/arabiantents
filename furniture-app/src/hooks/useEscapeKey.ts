import { useEffect } from "react"

export function useEscapeKey(enabled: boolean, callback: () => void) {
  useEffect(() => {
    const closeOnEscape = (event: KeyboardEvent) => {
      if (event.key === `Escape`) {
        callback()
      }
    }

    if (enabled) {
      document.addEventListener(`keydown`, closeOnEscape)
    }

    return () => {
      if (enabled) {
        document.removeEventListener(`keydown`, closeOnEscape)
      }
    }
  }, [enabled])
}
