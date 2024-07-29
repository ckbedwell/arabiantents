import React, { ReactNode, useCallback, useEffect, useState } from "react"
import styles from "./FurnitureItem.module.css"
import classNames from "classnames"
import { TFurnitureItem } from "~/types"
import { decodeHtml } from "~/App.utils"
import { QuantitySelector } from "../QuantitySelector/QuantitySelector"

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
        <Image item={item} onPhotoSelect={setImageIndex} type={`div`} />
        <div>
          {decodeHtml(item.title)}
        </div>
      </div>
      <div className={styles.content}>
        <Price item={item} />
        <QuantitySelector />
      </div>

      <Lightbox isOpen={lightboxOpen} onDismiss={() => setLightboxOpen(false)}>
        <Image item={item} initialIndex={imageIndex} type={`img`} />
      </Lightbox>
      <button className={classNames(styles.enlarge, styles.button)} onClick={() => setLightboxOpen(true)}>+</button>
    </div>
  )
}

type ImageProps = FurnitureItemProps & {
  initialIndex?: number;
  onPhotoSelect?: (index: number) => void;
  type: 'div' | 'img';
}

const Image = ({ item, initialIndex = 0, onPhotoSelect, type }: ImageProps) => {
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
      className={styles.image}
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
  useEffect(() => {
    const closeOnEscape = (event: KeyboardEvent) => {
      if (event.key === `Escape`) {
        onDismiss()
      }
    }

    if (isOpen) {
      document.querySelector(`body`).style.overflow = `hidden`
      document.addEventListener(`keydown`, closeOnEscape)
    }

    return () => {
      document.querySelector(`body`).style.overflow = `auto`
      document.removeEventListener(`keydown`, closeOnEscape)
    }
  }, [isOpen])

  if (!isOpen) {
    return null
  }

  return (
    <div className={styles.lightbox}>
      <div className={styles.backdrop} onClick={onDismiss} />
      <dialog aria-modal="true" className={styles.dialog} open={isOpen}>
        <div>
          <button className={classNames(styles.close, styles.button)} onClick={onDismiss}>X</button>
          {children}
        </div>
      </dialog>
    </div>
  )
}