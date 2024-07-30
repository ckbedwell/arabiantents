import React, { ReactNode } from 'react'
import styles from './Responsive.module.css'

export const Desktop = ({ children }: { children: ReactNode }) => {
  return (
    <div className={styles.desktop}>
      {children}
    </div>
  )
}

export const Tablet = ({ children }: { children: ReactNode }) => {
  return (
    <div className={styles.tablet}>
      {children}
    </div>
  )
}
