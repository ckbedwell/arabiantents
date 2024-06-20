import React, { useState } from 'react'
import styles from './quantitySelector.module.css'

export const QuantitySelector = () => {
  const [quantity, setQuantity] = useState(0)

  return (
    <div className={styles.container}>
      <button
        className={styles.button}
        onClick={() => {
          if (quantity > 0) {
            setQuantity(quantity - 1)
          }
        }}
      >
        -
      </button>
      <input
        className={styles.input}
        onChange={(e) => {
          setQuantity(Number(e.target.value))
        }}
        value={quantity}
      />
      <button
        className={styles.button}
        onClick={() => {
          setQuantity(quantity + 1)
        }}
      >
        +
      </button>
    </div>
  )
}
