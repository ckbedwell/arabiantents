import React, { useCallback, useEffect, useRef, useState } from 'react'
import styles from './quantitySelector.module.css'
import { TFurnitureItem } from '~/types'
import { useDispatch, useSelector } from 'react-redux'
import { RootState } from '~/Store/store'
import { setQuantity } from '~/Store/cartSlice'

interface QuantitySelectorProps {
  item: TFurnitureItem;
}

export const QuantitySelector = ({ item }: QuantitySelectorProps) => {
  const [internalValue, setInternalValue] = useState(`0`)
  const cartItems = useSelector((state: RootState) => state.cart.items)
  const cartItem = cartItems.find((c) => c.id === item.id)
  const cartItemQuantity = cartItem?.quantity || 0
  const dispatch = useDispatch()
  const hasFocus = useRef(null)
  const pendingValue = useRef(null)

  const handleSyncState = useCallback((value: string) => {
    setInternalValue(value)
  }, [])

  useEffect(() => {
    if (!hasFocus.current) {
      handleSyncState(String(cartItemQuantity))
    }
  }, [cartItemQuantity])

  const handleChange = (value: string) => {
    setInternalValue(value)
    const parsed = parseInt(value)

    if (typeof parsed === `number`) {
      dispatch(setQuantity({ itemId: item.id, quantity: parsed }))
    }
  }

  const handleDecrement = (e: React.MouseEvent<HTMLButtonElement, MouseEvent>) => {
    e.preventDefault()
    e.stopPropagation()
    const newValue: number = cartItemQuantity - 1

    if (newValue >= 0) {
      handleChange(String(newValue))
    }
  }

  const handleIncrement = (e: React.MouseEvent<HTMLButtonElement, MouseEvent>) => {
    e.preventDefault()
    e.stopPropagation()
    handleChange(String(cartItemQuantity + 1))
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
        onBlur={() => {
          hasFocus.current = false
          if (![``, null].includes(pendingValue.current)) {
            handleChange(pendingValue.current)
            pendingValue.current = null
          } else {
            handleSyncState(String(cartItemQuantity))
          }
        }}
        onChange={(e) => {
          pendingValue.current = e.target.value
          setInternalValue(e.target.value)
        }}
        onFocus={() => {
          hasFocus.current = true
        }}
        value={internalValue}
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
