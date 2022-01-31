const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin')
const path = require('path')

const prod = false

module.exports =  {
  mode: prod ? `production` : `development`,
  // devtool: prod ? `hidden-source-map` : `source-map`,
  entry: [`./css/style.css`],
  output: {
    path: `${path.resolve()}/compiled`,
    clean: true
  },
  optimization: {
    minimizer: [
      `...`,
      new CssMinimizerPlugin(),
    ],
  },
  module: {
    rules: [
      {
        test: /\.css$/i,
        use: [
          MiniCssExtractPlugin.loader,
          `css-loader`,
          `postcss-loader`,
        ],
      },
    ],
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: `css/[name].css`,
      ignoreOrder: true,
    }),
  ]
}
