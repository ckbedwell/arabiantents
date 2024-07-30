import React, { useCallback, useMemo, useState } from 'react'
import { Filter } from '../Filter/Filter'
import { Accordion } from '../Accordion'
import { TFilters, TFurnitureItem } from '~/types'
import { SortBy } from '../SortBy'
import { SortValue } from '~/App.utils'
import { Sidebar } from '../Sidebar'
import { Desktop, Tablet } from '../Responsive/Responsive'
import styles from './Filters.module.css'
import { ItemCount } from '../ItemCount'

export interface FiltersProps {
  filters: TFilters
  onChange: (type: string, value: string, checked: boolean) => void
  onSortChange: (value: SortValue) => void
  items: TFurnitureItem[]
}

export const TabletFilters = (props: FiltersProps) => {
  const [open, setOpen] = useState(false)

  const handleOpen = useCallback(() => {
    requestAnimationFrame(() => {
      setOpen(true)
    })
  }, [])

  const handleClose = useCallback(() => {
    requestAnimationFrame(() => {
      setOpen(false)
    })
  }, [])

  return (
    <Tablet>
      <button className={styles.button} onClick={handleOpen}>Open filters</button>
      {open && <Sidebar onDismiss={handleClose}>
        <div className={styles.sidebarContent}>
          <div>
            <ItemCount items={props.items} />
            <FiltersContent {...props} />
          </div>
          <button className={styles.closeFilters} onClick={handleClose}>Close filters</button>
        </div>
      </Sidebar>}
    </Tablet>
  )
}

export const DesktopFilters = (props: FiltersProps) => {
  return (
    <Desktop>
      <FiltersContent {...props} />
    </Desktop>
  )
}

const FiltersContent = ({
  filters,
  onChange,
  onSortChange,
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
      <SortBy onChange={onSortChange} />
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
