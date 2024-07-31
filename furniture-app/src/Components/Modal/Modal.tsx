import classNames from 'classnames'
import React, { ReactNode } from 'react'
import { useDisableBodyScroll } from '~/hooks/useDisableBodyScroll'
import { Icon } from '../Icon'

import styles from './Modal.module.css'
import { useEscapeKey } from '~/hooks/useEscapeKey'

interface ModalProps {
  closeOnOverlayClick?: boolean;
  children: ReactNode;
  isOpen: boolean;
  onDismiss: () => void;
}

export const Modal = ({
  children,
  closeOnOverlayClick = true,
  isOpen,
  onDismiss,
}: ModalProps) => {
  useDisableBodyScroll(isOpen, onDismiss)
  useEscapeKey(isOpen, onDismiss)

  if (!isOpen) {
    return null
  }

  return (
    <div className={styles.modal}>
      <div
        className={styles.backdrop}
        onClick={(e) => {
          if (closeOnOverlayClick) {
            e.preventDefault()
            e.stopPropagation()
            onDismiss()
          }
        }}
      />
      <dialog
        aria-modal="true"
        className={styles.dialog}
        open={isOpen}
      >
        <button
          autoFocus
          className={classNames(styles.close, styles.button)}
          onClick={onDismiss}
        >
          <Icon icon="cross" />
        </button>
        <div className={styles.dialogContent}>
          {children}
        </div>
      </dialog>
    </div>
  )
}
