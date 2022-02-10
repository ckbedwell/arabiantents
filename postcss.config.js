module.exports = {
  plugins: {
    'postcss-nested': {},
    'postcss-apply': {},
    'postcss-preset-env': {
      browsers: `last 2 versions`,
      importFrom: [{
        customMedia: generateMediaQueries({
          "desktopSmall": 1200,
          "tabletLarge": 1025,
          "tabletMedium": 992,
          "tabletSmall": 768,
          "mobileLarge": 620
        }),
      }],
    },
  },
}

function generateMediaQueries(target) {
  const prefixed = {}

  for (let key in target) {
    prefixed[`--above${capitalize(key)}`] = `(min-width: ${target[key] + 1}px)`
    prefixed[`--${key}`] = `(max-width: ${target[key]}px)`
  }

  return prefixed
}

function capitalize(word = ``, strict) {
  if (strict) {
    return `${word.charAt(0).toUpperCase()}${word.slice(1).toLowerCase()}`
  }

  return `${word.charAt(0).toUpperCase()}${word.slice(1)}`
}