import React, { useId } from 'react'
import { decodeHtml } from '~/App.utils'

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
  const id = useId().replace(/:/, `_`)

  return (
    <div>
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
