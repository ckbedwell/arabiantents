import React from 'react'
import classNames from 'classnames'
import styles from './Icon.module.css'

export const Icon = ({ as = 'span', icon, ...rest }: { as: keyof HTMLElementTagNameMap; icon: string }) => {
  const Tag = as

  return (
    <Tag
      className={classNames(styles.icon, `icon-${icon}`)}
      {...rest}
    />
  )
}
