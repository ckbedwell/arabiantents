import React from 'react'
import { TFurnitureItem } from '~/types'

export const ItemCount = ({ items }: { items: TFurnitureItem[] }) => {
  return (
    <div>
      Showing
      {` `}
      <strong>
        {items.length}
      </strong>
      {` `}
      out of
      {` `}
      {FURNITURE_ITEMS.length}
      {` `}
      items
    </div>
  )
}
