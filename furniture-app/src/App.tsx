import React, { useCallback, useState } from 'react'
import { Container } from '~/Components/Container'

import styles from './App.module.css'
import { FurnitureItems } from './Components/FurnitureItems/FurnitureItems'
import { TFurnitureItem } from '~/types'
import { DesktopFilters, TabletFilters } from '~/Components/Filters'
import { useFilters, useURLSearchParams } from './App.hooks'
import { SORT_OPTIONS, SortValue, filterItems, sortItems } from './App.utils'
import { Provider } from 'react-redux'
import { store } from './Store/store'
import { Basket } from './Components/Basket'
import { useSiteHeaderHeight } from './hooks/useSiteHeaderHeight'
import { ItemCount } from './Components/ItemCount'
import { Desktop } from './Components/Responsive/Responsive'
import { FiltersProps } from './Components/Filters/Filters'

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

  const filterProps = {
    filters,
    onChange: handleFilterChange,
    onSortChange: handleSortChange,
    items,
  }

  return (
    <Provider store={store}>
      <TopBar {...filterProps}
      />
      <Container>
        <div className={styles.grid}>
          <DesktopFilters {...filterProps} />
          <div>
            <FurnitureItems items={sortedItems} />
          </div>
        </div>
      </Container>
    </Provider>
  )
}

const TopBar = (props: FiltersProps) => {
  const headerHeight = useSiteHeaderHeight()

  return (
    <div className={styles.topBar} style={{ top: headerHeight }}>
      <Container>
        <div className={styles.topBarInner}>
          <TabletFilters {...props} />
          <Desktop>
            <ItemCount items={props.items} />
          </Desktop>
          <div className={styles.stack}>
            <Basket />
          </div>
        </div>
      </Container>
    </div>
  )
}
