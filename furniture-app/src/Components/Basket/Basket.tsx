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
import { Modal } from '../Modal'
import { CopiedForm } from '../CopiedForm'
import { useEscapeKey } from '~/hooks/useEscapeKey'

export const Basket = () => {
  const [isOpen, setIsOpen] = useState(false)
  const cartItems = useSelector((state: RootState) => state.cart.items)
  const itemsWithQuantity = cartItems.filter((item) => item.quantity > 0)
  const price = itemsWithQuantity.reduce((acc, item) => {
    const p = Number(item.price) || 0
    return acc + p * item.quantity
  }, 0)

  const numberOfItems = itemsWithQuantity.reduce((acc, item) => acc + item.quantity, 0)

  const handleClose = useCallback(() => {
    setIsOpen(false)
  }, [])

  const basketRef = useOnClickOutside<HTMLDivElement>(isOpen, handleClose)
  useEscapeKey(isOpen, handleClose)

  const handleClick = useCallback(() => {
    setIsOpen(v => !v)
  }, [])

  const totalPrice = getPrice(String(price), numberOfItems > 0)

  return (
    <div
      className={styles.container}
      ref={basketRef}
    >
      <button
        aria-label="Show all items"
        className={styles.button}
        onClick={handleClick}
      >
        <div className={styles.price}>
          <span>
            {totalPrice}
          </span>
          {numberOfItems > 0 &&
            <span>
              {`(${numberOfItems})`}
            </span>
          }
        </div>
        <Icon icon="basket" />
      </button>
      <div className={styles.anchor}>
        {isOpen && (
          <div className={styles.basket}>
            <BasketItems
              items={itemsWithQuantity}
              onClear={handleClose}
              totalPrice={totalPrice}
            />
          </div>
        )}
      </div>
    </div>
  )
}

function getPrice(price: string, hasItems: boolean) {
  if ([`0`, ``].includes(price) && hasItems) {
    return `POA`
  }

  return `£${Number(price)}.00`
}

interface BasketItemsProps {
  items: TFurnitureItem[]
  onClear: () => void
  totalPrice: string
}

const BasketItems = ({
  items,
  onClear,
  totalPrice,
}: BasketItemsProps) => {
  const [openEnquiry, setOpenEnquiry] = useState(false)

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
            <th className={styles.alignStart}>Image</th>
            <th className={styles.alignStart}>Item</th>
            <th className={styles.alignEnd}>Quantity</th>
            <th className={styles.alignEnd}>Price</th>
          </tr>
        </thead>
        <tbody>
          {items.map((item) => (
            <tr key={item.id}>
              <td className={styles.alignStart}>
                <img
                  className={styles.basketImage}
                  src={item.featured_image}
                />
              </td>
              <td className={styles.alignStart}>
                {item.title}
              </td>
              <td className={styles.alignEnd}>
                <QuantitySelector item={item} />
              </td>
              <td className={styles.alignEnd}>
                {getPrice(item.price, true)}
              </td>
            </tr>
          ))}
        </tbody>
        <tfoot>
          <tr>
            <td colSpan={2}>
              <ClearBasket onClear={onClear} />
            </td>
            <td className={styles.total}>Total</td>
            <td className={styles.alignEnd}>
              £
              {items.reduce((acc, item) => acc + Number(item.price) * item.quantity, 0)}
              .00
            </td>
          </tr>
        </tfoot>
      </table>
      <button
        className={styles.enquire}
        onClick={() => setOpenEnquiry(true)}
      >
        Send enquiry
      </button>
      <div className={styles.disclaimer}>
        The total price shown is an estimate and may vary from the final price. Price may be affected by availability, delivery location, and other factors. We will confirm the final price once we have received your enquiry.
      </div>
      <Modal
        closeOnOverlayClick={false}
        isOpen={openEnquiry}
        onDismiss={() => setOpenEnquiry(false)}
      >
        <CopiedForm
          items={items}
          totalPrice={totalPrice}
        />
      </Modal>
    </div>
  )
}

interface ClearBasketProps {
  onClear: () => void
}

const ClearBasket = ({ onClear }: ClearBasketProps) => {
  const [showConfirm, setShowConfirm] = useState(false)
  const dispatch = useDispatch()

  const handleClick = useCallback((e, value: boolean) => {
    e.preventDefault()
    e.stopPropagation()
    setShowConfirm(value)
  }, [])

  const handleClear = useCallback(() => {
    dispatch(clearAll())
    onClear()
  }, [])

  if (showConfirm) {
    return (
      <div className={styles.stack}>
        <div>
          Are you sure?
        </div>
        <button
          className={styles.clear}
          onClick={handleClear}
        >
          Confirm
        </button>
        <button onClick={(e) => handleClick(e, false)}>
          Cancel
        </button>
      </div>
    )
  }

  return (
    <button
      className={styles.clear}
      onClick={(e) => handleClick(e, true)}
    >
      Clear basket
    </button>
  )
}
