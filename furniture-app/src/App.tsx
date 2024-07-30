import React, { useCallback, useEffect, useState } from 'react'
import { Container } from '~/Components/Container'

import styles from './App.module.css'
import { FurnitureItems } from './Components/FurnitureItems/FurnitureItems'
import { TFurnitureItem } from '~/types'
import { Filters } from '~/Components/Filters'
import { useFilters, useURLSearchParams } from './App.hooks'
import { SORT_OPTIONS, SortValue, filterItems, sortItems } from './App.utils'
import { Provider } from 'react-redux'
import { store } from './Store/store'
import { Basket } from './Components/Basket'

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

  const handleSortChange = useCallback((option: SortValue) => {
    setSortOption(option)
    updateSearchParams(`replace`, option, `sort`)
  }, [])

  const items = filterItems(FURNITURE_ITEMS, filters)
  const sortedItems = sortItems(items, sortOption)

  return (
    <Provider store={store}>
      <Container>
        <TopBar
          items={sortedItems}
        />
        <div className={styles.grid}>
          <Filters
            filters={filters}
            onChange={handleFilterChange}
            onSortChange={handleSortChange}
          />
          <FurnitureItems items={sortedItems} />
        </div>
      </Container>
    </Provider>
  )
}

const TopBar = ({
  items,
}: { items: TFurnitureItem[] }) => {
  const [headerHeight, setHeaderHeight] = useState(getHeader()?.clientHeight || 84);

  useEffect(() => {
    const headerElement = document.querySelector('.site-header');

    if (headerElement) {
      const resizeObserver = new ResizeObserver((entries) => {
        for (let entry of entries) {
          if (entry.target === headerElement) {
            setHeaderHeight(headerElement.clientHeight);
          }
        }
      });

      resizeObserver.observe(headerElement);

      return () => {
        resizeObserver.unobserve(headerElement);
      };
    }
  }, []);

  return (
    <div className={styles.topBar} style={{ top: headerHeight }}>
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

        <Basket />
      </div>
    </div>
  )
}

function getHeader() {
  return document.querySelector('.site-header')
}
