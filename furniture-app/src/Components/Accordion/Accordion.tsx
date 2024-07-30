import React, { ReactNode, useState } from 'react'
import styles from './Accordion.module.css'
import { Icon } from '../Icon'

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
        <Icon icon={open ? "arrow-down" : "arrow-right2"} />
      </button>
      {open && <div>
        {children}
      </div>
      }
    </div>
  )
}
