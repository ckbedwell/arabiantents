import React from 'react'
import { useDisableBodyScroll } from '~/hooks/useDisableBodyScroll'
import { useOnClickOutside } from '~/hooks/useOnClickOutside'
import styles from './Sidebar.module.css'

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

  return (
    <div
      className={styles.container}
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
