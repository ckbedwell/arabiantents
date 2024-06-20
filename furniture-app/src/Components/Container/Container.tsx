import React, { ReactNode } from 'react'
import styles from './container.module.css'

export const Container = ({ children }: { children: ReactNode }) => {
  return (
    <div className={styles.container}>
      {children}
    </div>
  )
}
