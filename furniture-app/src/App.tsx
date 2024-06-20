import React, { useCallback, useState } from 'react'
import { Container } from '~/Components/Container'

import styles from './app.module.css'
import { FurnitureItems } from './Components/FurnitureItems/FurnitureItems'
import { TFurnitureItem } from '~/types'
import { Filters } from '~/Components/Filters'
import { useFilters, useURLSearchParams } from './App.hooks'
import { SORT_OPTIONS, SortValue, filterItems, sortItems } from './App.utils'

declare global {
  // eslint-disable-next-line no-unused-vars
  const FURNITURE_ITEMS: TFurnitureItem[]
}

export const App = () => {
  const [filters, dispatch] = useFilters()
  const updateSearchParams = useURLSearchParams()
  const [sortOption, setSortOption] = useState<SortValue>(SORT_OPTIONS[0].value)

  const handleFilterChange = useCallback((type: string, value: string, checked: boolean) => {
    const actionType = checked ? `add` : `remove`
    dispatch({ type: actionType, payload: { type, value: [value] } })
    updateSearchParams(actionType, value, type)
  }, [])

  const items = filterItems(FURNITURE_ITEMS, filters)
  const sortedItems = sortItems(items, sortOption)

  return (
    <Container>
      <TopBar
        items={sortedItems}
        onSort={(option) => {
          setSortOption(option)
          updateSearchParams(`replace`, option, `sort`)
        }}
      />
      <div className={styles.grid}>
        <Filters
          filters={filters}
          onChange={handleFilterChange}
        />
        <FurnitureItems items={sortedItems} />
      </div>
    </Container>
  )
}

const TopBar = ({
  items,
  onSort,
}: { items: TFurnitureItem[]; onSort: (option: SortValue) => void }) => {
  return (

    <div className={styles.topBar}>
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
      <div className={styles.stack}>
        Sort by:
        <select onChange={(e) => onSort(e.target.value as SortValue)}>
          {SORT_OPTIONS.map((option) => (
            <option
              key={option.value}
              value={option.value}
            >
              {option.label}
            </option>
          ))}
        </select>
      </div>
    </div>
  )
}
