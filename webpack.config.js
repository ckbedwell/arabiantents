const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin')
const BrowserSyncPlugin = require('browser-sync-webpack-plugin')
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
          {
            loader: `css-loader`,
            options: {
              importLoaders: 1,
            }
          },
          `postcss-loader`,
        ],
      },
    ],
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: `css/[name].css`,
    }),
    new BrowserSyncPlugin({
      proxy: 'http://localhost/arabiantents/',
      port: 80,
    })
  ]
}
