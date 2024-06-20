import React, { ReactNode, useState } from 'react'
import classNames from 'classnames'
import styles from './accordion.module.css'

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
        <span
          className={classNames({
            [styles.icon]: true,
            'icon-arrow-right2': !open,
            'icon-arrow-down': open,
          })}
        />
      </button>
      {open && <div>
        {children}
      </div>
      }
    </div>
  )
}
