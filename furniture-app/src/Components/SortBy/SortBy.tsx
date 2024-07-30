import React from 'react'
import { SORT_OPTIONS, SortValue } from '~/App.utils'
import styles from './SortBy.module.css'
import { Accordion } from '../Accordion';

interface SortByProps {
  onChange: (value: SortValue) => void;
}

export const SortBy = ({ onChange }: SortByProps) => {
  return (
    <Accordion label="Sort by">
      <select className={styles.sortBy} onChange={(e) => onChange(e.target.value as SortValue)}>
        {SORT_OPTIONS.map((option) => (
          <option
            key={option.value}
            value={option.value}
          >
            {option.label}
          </option>
        ))}
      </select>
    </Accordion>
  )
}