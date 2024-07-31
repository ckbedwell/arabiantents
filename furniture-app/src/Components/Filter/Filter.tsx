import React, { useId } from 'react'
import { decodeHtml } from '~/App.utils'
import styles from './Filter.module.css'

interface FilterProps {
  checked: boolean
  label: string
  onChange: (checked: boolean) => void
}

export const Filter = ({
  checked,
  label,
  onChange,
}: FilterProps) => {
  const regEx = /:/g
  const id = useId().replace(regEx, `_`)

  return (
    <div className={styles.container}>
      <input
        checked={checked}
        id={id}
        key={checked ? `checked` : `unchecked`}
        onChange={(e) => {
          e.preventDefault()
          e.stopPropagation()
          onChange(e.target.checked)
        }}
        type="checkbox"
      />
      <label htmlFor={id}>
        {decodeHtml(label)}
      </label>
    </div>
  )
}
