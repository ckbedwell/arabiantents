import React, { forwardRef, useCallback } from 'react'
import styles from './quantitySelector.module.css'
import { TFurnitureItem } from '~/types'
import { useDispatch, useSelector } from 'react-redux'
import { RootState } from '~/Store/store'
import { setQuantity } from '~/Store/cartSlice'

interface QuantitySelectorProps {
  item: TFurnitureItem;
}

export const QuantitySelector = ({ item }: QuantitySelectorProps) => {
  const cartItems = useSelector((state: RootState) => state.cart.items)
  const cartItem = cartItems.find((cartItem) => cartItem.id === item.id)
  const cartItemQuantity = cartItem?.quantity || 0
  const dispatch = useDispatch()

  const handleDecrement = () => {
    requestAnimationFrame(() => {
      const newvalue = cartItemQuantity - 1

      if (newvalue >= 0) {
        dispatch(setQuantity({ itemId: item.id, quantity: newvalue }))
      }
    })
  }

  const handleIncrement = () => {
    requestAnimationFrame(() => {
      const newValue = cartItemQuantity + 1
      dispatch(setQuantity({ itemId: item.id, quantity: newValue }))
    })
  }

  return (
    <div className={styles.container}>
      <button
        className={styles.button}
        onClick={handleDecrement}
      >
        -
      </button>
      <input
        className={styles.input}
        onChange={(e) => {
          const value = Number(e.target.value)

          if (value >= 0) {
            requestAnimationFrame(() => {
              dispatch(setQuantity({ itemId: item.id, quantity: Number(e.target.value) }))
            })
          }
        }}
        value={cartItemQuantity}
      />
      <button
        className={styles.button}
        onClick={handleIncrement}
      >
        +
      </button>
    </div>
  )
}
