import React, { ReactNode, useState } from 'react'
import styles from './Accordion.module.css'

interface AccordionProps {
  children: ReactNode
  label: string
  isOpen?: boolean
}

export const Accordion = ({
  children,
  label,
  isOpen = true,
}: AccordionProps) => {
  const [open, setOpen] = useState(isOpen)

  return (
    <div>
      <button
        className={styles.button}
        onClick={() => setOpen(v => !v)}
      >
        {label}
        <span className={open ? `icon-arrow-right2` : `icon-arrow-down`} />
      </button>
      {open && <div>
        {children}
      </div>
      }
    </div>
  )
}
