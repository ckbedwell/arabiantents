import React, { useCallback, useState } from 'react'
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
  selectedFilters: TFilters
  onChange: (type: string, value: string, checked: boolean) => void
  onClear: () => void
  onSortChange: (value: SortValue) => void
  sortOption: SortValue
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
      <button
        className={styles.button}
        onClick={handleOpen}
      >
        {getLabel(props.selectedFilters)}
      </button>
      {open && <Sidebar onDismiss={handleClose}>
        <div className={styles.sidebarContent}>
          <div>
            <div className={styles.tabletTopBar}>
              <ItemCount items={props.items} />
              <ClearFilters
                hasCount={props.selectedFilters.furniture_type.length + props.selectedFilters.color.length > 0}
                label="Clear"
                onClear={props.onClear}
              />
            </div>
            <FiltersContent {...props} />
          </div>
          <button
            className={styles.closeFilters}
            onClick={handleClose}
          >
            Close
          </button>
        </div>
      </Sidebar>}
    </Tablet>
  )
}

function getLabel(selectedFilters: TFilters) {
  const furnitureTypeCount = selectedFilters.furniture_type.length
  const colorCount = selectedFilters.color.length
  const totalCount = furnitureTypeCount + colorCount

  if (!totalCount) {
    return `Open Filters`
  }

  return `Open Filters (${totalCount})`
}

export const DesktopFilters = (props: FiltersProps) => {
  const hasCount = props.selectedFilters.furniture_type.length + props.selectedFilters.color.length > 0

  return (
    <Desktop>
      <FiltersContent {...props} />
      <ClearFilters
        hasCount={hasCount}
        label={`Clear all filters`}
        onClear={props.onClear}
      />
    </Desktop>
  )
}

const FiltersContent = ({
  filters,
  selectedFilters,
  onChange,
  onSortChange,
  sortOption,
}: FiltersProps) => {
  const furnitureTypeCount = selectedFilters.furniture_type.length
  const colorCount = selectedFilters.color.length

  return (
    <div>
      <SortBy
        onChange={onSortChange}
        value={sortOption}
      />
      <Accordion label={constructLabel(`Type`, furnitureTypeCount)}>
        {filters.furniture_type.map((value) => {
          return (
            <Filter
              checked={selectedFilters.furniture_type.includes(value)}
              key={value}
              label={value}
              onChange={(checked) => onChange(`furniture_type`, value, checked)}
            />
          )
        })}
      </Accordion>
      <Accordion label={constructLabel(`Color`, colorCount)}>
        {filters.color.map((value) => {
          return (
            <Filter
              checked={selectedFilters.color.includes(value)}
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

interface ClearFiltersProps {
  hasCount: boolean
  label: string
  onClear: () => void
}

const ClearFilters = ({
  hasCount,
  label,
  onClear,
}: ClearFiltersProps) => {
  if (hasCount) {
    return (
      <button
        className={styles.clear}
        onClick={onClear}
      >
        {label}
      </button>
    )
  }

  return null
}

function constructLabel(label, count) {
  if (!count) {
    return label
  }

  return `${label} (${count})`
}
