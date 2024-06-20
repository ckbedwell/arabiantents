import React from 'react'
import styles from './FurnitureItems.module.css'
import { FurnitureItem } from '~/Components/FurnitureItem'
import { TFurnitureItem } from '~/types'

export const FurnitureItems = ({ items }: { items: TFurnitureItem[] }) => {
  const hasItems = items.length > 0

  if (!hasItems) {
    return <div>No items match your selection. Refine your search.</div>
  }

  return (
    <div className={styles.grid}>
      {items.map((item) => {
        return (
          <FurnitureItem
            item={item}
            key={item.id}
          />
        )
      })}
    </div>
  )
}
