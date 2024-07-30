import React, { ReactNode, useCallback, useEffect, useState } from "react"
import styles from "./FurnitureItem.module.css"
import classNames from "classnames"
import { TFurnitureItem } from "~/types"
import { decodeHtml } from "~/App.utils"
import { QuantitySelector } from "../QuantitySelector/QuantitySelector"
import { Icon } from "../Icon"
import { useDisableBodyScroll } from "~/hooks/useDisableBodyScroll"

interface FurnitureItemProps {
  item: TFurnitureItem;
}

export const FurnitureItem = ({ item }: FurnitureItemProps) => {
  const [imageIndex, setImageIndex] = useState(0)
  const [lightboxOpen, setLightboxOpen] = useState(false)

  return (
    <div
      className={styles.item}
    >
      <div>
        <Image item={item} onClick={() => setLightboxOpen(true)} onPhotoSelect={setImageIndex} type={`div`} />
        <div>
          {decodeHtml(item.title)}
        </div>
      </div>
      <div className={styles.content}>
        <Price item={item} />
        <QuantitySelector item={item} />
      </div>

      <Lightbox isOpen={lightboxOpen} onDismiss={() => setLightboxOpen(false)}>
        <Image item={item} initialIndex={imageIndex} type={`img`} />
        <div>
          {decodeHtml(item.title)}
        </div>
        <div className={styles.content}>
          <Price item={item} />
          <QuantitySelector item={item} />
        </div>
      </Lightbox>
      <button className={classNames(styles.enlarge, styles.button)} onClick={() => setLightboxOpen(true)}>
        <Icon icon="search" />
      </button>
    </div>
  )
}

type ImageProps = FurnitureItemProps & {
  initialIndex?: number;
  onClick?: () => void;
  onPhotoSelect?: (index: number) => void;
  type: 'div' | 'img';
}

const Image = ({ item, initialIndex = 0, onClick, onPhotoSelect, type }: ImageProps) => {
  const [imageIndex, setImageIndex] = useState(initialIndex)
  const photos = [...Array.from(new Set([
    item.featured_image,
    ...item.photos,
  ]))]

  const handleOnClick = useCallback((index: number) => {
    onPhotoSelect?.(index)
    setImageIndex(index)
  }, [])

  const content = type === `img` ? (
    <img src={photos[imageIndex]} alt={item.title} />
  ) : (

    <div
      aria-label={item.title}
      className={classNames(styles.image, {
        [styles.clickable]: Boolean(onClick),
      })}
      onClick={onClick}
      role="img"
      style={{ backgroundImage: `url(${photos[imageIndex]}` }}
    >
      <span className={styles.screenReaderOnly}>
        {item.title}
      </span>
    </div>
  )
  return (
    <div className={styles.container}>
      {content}
      <PhotoSelector imageIndex={imageIndex} photos={photos} onClick={handleOnClick} />
    </div>
  )
}

const PhotoSelector = ({ imageIndex, photos, onClick }) => {
  if (photos.length > 1) {
    return (
      <ul className={styles.photoSelector}>
        {photos.map((photo, index) => {
          return (
            <li key={photo}>
              <button
                className={`${styles.photoButton} ${index === imageIndex ? styles.active : ``}`}
                onClick={() => onClick(index)}
              />
            </li>
          )
        })}
      </ul>
    )
  }

  return null
}

const Price = ({ item }: FurnitureItemProps) => {
  const price = item.price

  if (!price) {
    return (
      <div className={styles.enquirePrice}>
        Enquire for price
      </div>
    )
  }

  return (
    <div className={styles.price}>
      {item.from_prefix === `1` && `From `}
      {`£${item.price}`}
    </div>
  )
}

const Lightbox = ({ children, isOpen, onDismiss }: { children: ReactNode, isOpen: boolean; onDismiss: () => void }) => {
  useDisableBodyScroll(isOpen, onDismiss)

  if (!isOpen) {
    return null
  }

  return (
    <div className={styles.lightbox}>
      <div className={styles.backdrop} onClick={onDismiss} />
      <dialog aria-modal="true" className={styles.dialog} open={isOpen}>
        <div>
          <button autoFocus className={classNames(styles.close, styles.button)} onClick={onDismiss}>
            <Icon icon="cross" />
          </button>
          {children}
        </div>
      </dialog>
    </div>
  )
}