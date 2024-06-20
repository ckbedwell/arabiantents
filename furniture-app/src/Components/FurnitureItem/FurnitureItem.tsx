import React, { useState } from "react"
import styles from "./FurnitureItem.module.css"
import { TFurnitureItem } from "~/types"
import { decodeHtml } from "~/App.utils"

interface FurnitureItemProps {
  item: TFurnitureItem;
}

export const FurnitureItem = ({ item }: FurnitureItemProps) => {
  return (
    <div>
      <Image item={item} />
      <div className={styles.content}>
        <div>
          {decodeHtml(item.title)}
        </div>
        <Price item={item} />
      </div>
    </div>
  )
}

const Image = ({ item }: FurnitureItemProps) => {
  const [imageIndex, setImageIndex] = useState(0)
  const photos = [...Array.from(new Set([
    item.featured_image,
    ...item.photos,
  ]))]

  return (
    <div className={styles.container}>
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
      {photos.length > 1 && <ul className={styles.photoSelector}>
        {photos.map((photo, index) => {
          return (
            <li key={photo}>
              <button
                className={`${styles.photoButton} ${index === imageIndex ? styles.active : ``}`}
                onClick={() => setImageIndex(index)}
              />
            </li>
          )
        })}
      </ul>}
    </div>
  )
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
    <div>
      {item.from_prefix === `1` && `From `}
      {`£${item.price}`}
    </div>
  )
}
