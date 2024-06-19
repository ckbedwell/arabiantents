const mediaSizes = require(`./mediaSizes.json`)

module.exports = {
  plugins: {
    'postcss-nested': {},
    'postcss-preset-env': {
      autoprefixer: {
        grid: true,
      },
      browsers: `last 2 versions`,
      features: {
        'custom-media-queries': {},
        'custom-properties': {
          disableDeprecationNotice: true,
          preserve: true,
        },
      },
      importFrom: [{
        customMedia: prefixProperties(mediaSizes),
      }],
    },
  },
}

function prefixProperties(target) {
  const prefixed = {}

  for (const key in target) {
    prefixed[`--above${capitalize(key)}`] = `(min-width: ${target[key] + 1}px)`
    prefixed[`--${key}`] = `(max-width: ${target[key]}px)`
  }

  return prefixed
}

function capitalize(word) {
  return `${word.charAt(0).toUpperCase()}${word.slice(1)}`
}
