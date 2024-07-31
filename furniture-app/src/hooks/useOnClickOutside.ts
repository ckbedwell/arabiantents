import { useEffect, useRef } from "react"

export function useOnClickOutside<T extends HTMLElement>(enabled: boolean, callback: () => void) {
  const ref = useRef<T>(null)

  useEffect(() => {
    const handleClickOutside = (e: MouseEvent) => {
      const isHTMLElement = e.target instanceof HTMLElement
      const isElementInDocumentStill = document.contains(e.target as Node)

      if (isElementInDocumentStill && isHTMLElement && ref.current && !ref.current.contains(e.target)) {
        callback()
      }
    }

    if (enabled) {
      document.addEventListener(`click`, handleClickOutside)
    }

    return () => {
      if (enabled) {
        document.removeEventListener(`click`, handleClickOutside)
      }
    }
  }, [callback, enabled])

  return ref
}
