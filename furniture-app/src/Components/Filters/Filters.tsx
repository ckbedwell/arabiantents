import React, { useMemo } from 'react'
import { Filter } from '../Filter/Filter'
import { Accordion } from '../Accordion'
import { TFilters } from '~/types'

interface FiltersProps {
  filters: TFilters
  onChange: (type: string, value: string, checked: boolean) => void
}

export const Filters = ({
  filters,
  onChange,
}: FiltersProps) => {
  const {
    price,
    color,
    furniture_type,
  } = useMemo(() => constructFilters(), [])

  const orderedFurnitureType = furniture_type.sort()
  const orderedColor = color.sort()

  return (
    <div>
      <Accordion label="Type">
        {orderedFurnitureType.map((value) => {
          return (
            <Filter
              checked={filters.furniture_type.includes(value)}
              key={value}
              label={value}
              onChange={(checked) => onChange(`furniture_type`, value, checked)}
            />
          )
        })}
      </Accordion>
      <Accordion label="Color">
        {orderedColor.map((value) => {
          return (
            <Filter
              checked={filters.color.includes(value)}
              key={value}
              label={value}
              onChange={(checked) => onChange(`color`, value, checked)}
            />
          )
        })}
      </Accordion>
    </div>
  )
}

function constructFilters() {
  return FURNITURE_ITEMS.reduce((acc, item) => {
    const {
      price,
      color,
      furniture_type,
    } = item

    if (!acc.price.includes(price)) {
      acc.price.push(price)
    }

    color.forEach((c) => {
      if (!acc.color.includes(c)) {
        acc.color.push(c)
      }
    })

    furniture_type.forEach((f) => {
      if (!acc.furniture_type.includes(f)) {
        acc.furniture_type.push(f)
      }
    })

    return acc
  }, {
    price: [],
    color: [],
    furniture_type: [],
  })
}
