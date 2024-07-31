import React, { useCallback, useMemo, useState } from 'react'
import { Container } from '~/Components/Container'

import styles from './App.module.css'
import { FurnitureItems } from './Components/FurnitureItems/FurnitureItems'
import { TFilters, TFurnitureItem } from '~/types'
import { DesktopFilters, TabletFilters } from '~/Components/Filters'
import { useFilters, useURLSearchParams } from './App.hooks'
import { SORT_OPTIONS, SortValue, filterItems, sortItems } from './App.utils'
import { Provider } from 'react-redux'
import { store } from './Store/store'
import { Basket } from './Components/Basket'
import { useSiteHeaderHeight } from './hooks/useSiteHeaderHeight'
import { ItemCount } from './Components/ItemCount'
import { Desktop, Tablet } from './Components/Responsive/Responsive'
import { FiltersProps } from './Components/Filters/Filters'
import { useSearchParams } from 'react-router-dom'

declare global {
  // eslint-disable-next-line no-unused-vars
  const FURNITURE_ITEMS: TFurnitureItem[]
}

export const App = () => {
  const [selectedFilters, dispatch] = useFilters()
  const updateSearchParams = useURLSearchParams()
  const initialSort = useGetInitialSort()
  const [sortOption, setSortOption] = useState<SortValue>(initialSort)

  const handleFilterChange = useCallback((type: string, value: string, checked: boolean) => {
    const actionType = checked ? `add` : `remove`
    dispatch({ type: actionType, payload: { type, value: [value] } })
    updateSearchParams(actionType, value, type)
  }, [])

  const handleSortChange = useCallback((option: SortValue) => {
    setSortOption(option)
    updateSearchParams(`replace`, option, `sort`)
  }, [])

  const items = filterItems(FURNITURE_ITEMS, selectedFilters)
  const sortedItems = sortItems(items, sortOption)

  const filters = useMemo(() => constructFilters(), [])

  const filterProps = {
    filters,
    selectedFilters,
    onChange: handleFilterChange,
    onSortChange: handleSortChange,
    sortOption,
    items,
  }

  return (
    <Provider store={store}>
      <TopBar {...filterProps} />
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
    <>
      <Tablet>
        <div className={styles.tabletItemCountWrapper}>
          <ItemCount items={props.items} />
        </div>
      </Tablet>
      <div
        className={styles.topBar}
        style={{ top: headerHeight }}
      >
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
    </>
  )
}

function useGetInitialSort() {
  const [params] = useSearchParams()
  const sort = params.get(`sort`)

  return sort as SortValue || SORT_OPTIONS[0].value
}

function constructFilters() {
  const reduced = FURNITURE_ITEMS.reduce<TFilters>((acc, item, index) => {
    const {
      color,
      furniture_type,
    } = item

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
    color: [],
    furniture_type: [],
  })

  return {
    color: reduced.color.sort(),
    furniture_type: reduced.furniture_type.sort(),
  }
}
