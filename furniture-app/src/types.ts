export interface TFilters {
  color: string[]
  furniture_type: string[]
}

export type TFurnitureItem = {
  color: string[]
  featured_image: string
  from_prefix: `1` | `0`
  furniture_type: string[]
  id: number
  price: string
  title: string
  description: string
  photos: string[]
  quantity: number
}
