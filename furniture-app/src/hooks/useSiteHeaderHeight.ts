import { useEffect, useState } from "react"

export function useSiteHeaderHeight() {
  const [headerHeight, setHeaderHeight] = useState(getHeader()?.clientHeight || 84)

  useEffect(() => {
    const headerElement = getHeader()

    if (headerElement) {
      const resizeObserver = new ResizeObserver((entries) => {
        for (let entry of entries) {
          if (entry.target === headerElement) {
            setHeaderHeight(headerElement.clientHeight)
          }
        }
      })

      resizeObserver.observe(headerElement)

      return () => {
        resizeObserver.unobserve(headerElement)
      }
    }
  }, [])

  return headerHeight
}

function getHeader() {
  return document.querySelector(`.site-header`)
}
