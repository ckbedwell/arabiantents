import { TFilters, TFurnitureItem } from "./types"

export type SortValue = `` | `price_asc` | `price_desc` | `a_to_z` | `z_to_a`

interface TSortOption {
  label: string
  value: SortValue
}

export const SORT_OPTIONS: TSortOption[] = [
  { label: `Newest`, value: `` },
  { label: `Price asc.`, value: `price_asc` },
  { label: `Price desc.`, value: `price_desc` },
  { label: `Name asc.`, value: `a_to_z` },
  { label: `Name desc.`, value: `z_to_a` },
]

export function filterItems(
  originalItems: TFurnitureItem[],
  filters: TFilters
) {
  return originalItems.filter((item) => {
    if (
      filters.color.length > 0 &&
      !filters.color.some((c) => item.color.includes(c))
    ) {
      return false
    }

    if (
      filters.furniture_type.length > 0 &&
      !filters.furniture_type.some((f) => item.furniture_type.includes(f))
    ) {
      return false
    }

    return true
  })
}

export function sortItems(
  originalItems: TFurnitureItem[],
  sortValue: SortValue
) {
  return originalItems.sort((a, b) => {
    if (sortValue === `price_asc`) {
      return sortByPrice(a, b)
    }

    if (sortValue === `price_desc`) {
      return sortByPrice(b, a)
    }

    if (sortValue === `a_to_z`) {
      return sortByName(a, b)
    }

    if (sortValue === `z_to_a`) {
      return sortByName(b, a)
    }

    return 0
  })
}

const UNPRICED_VAL = 99999999

function sortByPrice(a: TFurnitureItem, b: TFurnitureItem) {
  const aPrice = a.price === `` ? UNPRICED_VAL : parseFloat(a.price)
  const bPrice = b.price === `` ? UNPRICED_VAL : parseFloat(b.price)

  return aPrice - bPrice
}

function sortByName(a: TFurnitureItem, b: TFurnitureItem) {
  return b.title.localeCompare(a.title)
}

export function decodeHtml(html) {
  let txt = document.createElement(`textarea`)
  txt.innerHTML = html
  const decoded = txt.value
  txt.remove()

  return decoded
}
