module.exports = {
  plugins: {
    'postcss-nested': {},
    'postcss-apply': {},
    'postcss-preset-env': {
      browsers: `last 2 versions`,
      features: {
        'custom-media-queries': {},
      }
    },
  },
}
