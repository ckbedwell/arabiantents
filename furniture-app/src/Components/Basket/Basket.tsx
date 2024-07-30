import React, { useCallback, useState } from 'react'
import { useDispatch, useSelector } from 'react-redux'
import classNames from 'classnames'
import { Icon } from '~/Components/Icon'
import { RootState } from '~/Store/store'
import styles from './Basket.module.css'
import { TFurnitureItem } from '~/types'
import { QuantitySelector } from '../QuantitySelector'
import { clearAll } from '~/Store/cartSlice'
import { useOnClickOutside } from '~/hooks/useOnClickOutside'

export const Basket = () => {
  const [isOpen, setIsOpen] = useState(false)
  const cartItems = useSelector((state: RootState) => state.cart.items)
  const itemsWithQuantity = cartItems.filter((item) => item.quantity > 0)
  const price = itemsWithQuantity.reduce((acc, item) => {
    const price = Number(item.price) || 0
    return acc + price * item.quantity
  }, 0)
  const basketRef = useOnClickOutside<HTMLDivElement>(() => setIsOpen(false))

  const handleClick = useCallback(() => {
    setIsOpen(v => !v)
  }, [])


  return (
    <div className={styles.container} ref={basketRef}>
      <button aria-label="Show all items" className={styles.button} onClick={handleClick}>
        <div className={styles.price}>
          £{price}.00
        </div>
        <Icon icon="basket" />
      </button>
      <div className={styles.anchor}>
        {isOpen && (
          <div className={styles.basket}>
            <BasketItems items={itemsWithQuantity} />
          </div>
        )}
      </div>
    </div>
  )
}

const BasketItems = ({ items }: { items: TFurnitureItem[] }) => {
  if (!items.length) {
    return (
      <div className={classNames(styles.basketItemsContainer, styles.empty)}>
        Your basket is empty
      </div>
    )
  }

  return (
    <div className={styles.basketItemsContainer}>
      <table className={styles.table}>
        <thead>
          <tr>
            <th>Image</th>
            <th>Item</th>
            <th>Quantity</th>
            <th>Price</th>
          </tr>
        </thead>
        <tbody>
          {items.map((item) => (
            <tr key={item.id}>
              <td><img className={styles.basketImage} src={item.featured_image} /></td>
              <td>{item.title}</td>
              <td><QuantitySelector item={item} /></td>
              <td>{getPrice(item.price)}</td>
            </tr>
          ))}
        </tbody>
        <tfoot>
          <tr>
            <td colSpan={2}>
              < ClearBasket />
            </td>
            <td className={styles.total}>Total</td>
            <td>£{items.reduce((acc, item) => acc + Number(item.price) * item.quantity, 0)}.00</td>
          </tr>
        </tfoot>
      </table>
      <div className={styles.disclaimer}>
        The total price shown is an estimate and may vary from the final price. Price may be affected by availability, delivery location, and other factors. We will confirm the final price once we have received your enquiry.
      </div>
    </div>
  )
}

const ClearBasket = () => {
  const [showConfirm, setShowConfirm] = useState(false)
  const dispatch = useDispatch()

  const handleClick = (value: boolean) => {
    requestAnimationFrame(() => {
      setShowConfirm(value)
    })
  }

  if (showConfirm) {
    return (
      <div className={styles.stack}>
        <div>
          Are you sure?
        </div>
        <button className={styles.clear} onClick={() => dispatch(clearAll())}>
          Confirm
        </button>
        <button onClick={() => handleClick(false)}>
          Cancel
        </button>
      </div>
    )
  }

  return (
    <button className={styles.clear} onClick={() => handleClick(true)}>
      Clear basket
    </button>
  )
}

function getPrice(price?: string) {
  if (!price) {
    return `POA`
  }

  return `£${Number(price)}.00`
}