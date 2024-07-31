import { createSlice } from '@reduxjs/toolkit'
import type { PayloadAction } from '@reduxjs/toolkit'
import { TFurnitureItem } from "~/types"

export interface CartState {
  items: TFurnitureItem[]
}

const initialState: CartState = {
  items: getInitialItems(),
}

interface Payload {
  itemId: TFurnitureItem[`id`];
  quantity: number;
}

export const cartSlice = createSlice({
  name: `cart`,
  initialState,
  reducers: {
    clearAll(state) {
      state.items = []
    },
    setQuantity: (state, action: PayloadAction<Payload>) => {
      const quantity = action.payload.quantity

      if (quantity === 0) {
        state.items = state.items.filter((item) => item.id !== action.payload.itemId)
        return
      }

      const existsInCart = state.items.find((item) => item.id === action.payload.itemId)

      if (existsInCart) {
        existsInCart.quantity = action.payload.quantity
        return
      }

      const newItem = FURNITURE_ITEMS.find((item) => item.id === action.payload.itemId)

      if (newItem) {
        state.items.push({
          ...newItem,
          quantity: action.payload.quantity,
        })
      }
    },
  },
})

// Action creators are generated for each case reducer function
export const {
  clearAll,
  setQuantity,
} = cartSlice.actions

export const cartReducer = cartSlice.reducer

function getInitialItems() {
  const existingCart = localStorage.getItem(`cartItems`)

  if (!existingCart) {
    return []
  }

  try {
    return JSON.parse(existingCart)
  } catch {
    return []
  }
}
