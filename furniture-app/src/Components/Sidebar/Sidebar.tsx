import React from 'react'
import { useDisableBodyScroll } from '~/hooks/useDisableBodyScroll'
import { useOnClickOutside } from '~/hooks/useOnClickOutside'
import styles from './Sidebar.module.css'
import { useSiteHeaderHeight } from '~/hooks/useSiteHeaderHeight'

interface SidebarProps {
  children: React.ReactNode
  onDismiss: () => void
}

export const Sidebar = ({
  children,
  onDismiss,
}: SidebarProps) => {
  const sidebarRef = useOnClickOutside<HTMLDivElement>(true, onDismiss)
  useDisableBodyScroll(true, onDismiss)
  const headerHeight = useSiteHeaderHeight()

  return (
    <div
      className={styles.container}
      // @ts-expect-error
      style={{ '--offset': `${headerHeight}px` }}
    >
      <div
        className={styles.content}
        ref={sidebarRef}
      >
        {children}
      </div>
      <div className={styles.overlay} />
    </div>
  )
}
