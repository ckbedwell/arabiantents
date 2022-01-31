module.exports = {
  plugins: {
    'postcss-nested': {},
    'postcss-preset-env': {
      autoprefixer: {
        grid: true,
      },
      browsers: `last 2 versions`,
    },
  },
}
