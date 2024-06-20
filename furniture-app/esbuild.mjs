import * as esbuild from "esbuild"
import CssModulesPlugin from "esbuild-css-modules-plugin"

esbuild
  .build({
    entryPoints: [`src/main.tsx`],
    bundle: true,
    outfile: `dist/furnitureApp.js`,
    minify: true,
    plugins: [
      CssModulesPlugin({
        // @see https://github.com/indooorsman/esbuild-css-modules-plugin/blob/main/index.d.ts for more details
        force: true,
        emitDeclarationFile: false,
        localsConvention: `camelCaseOnly`,
        namedExports: true,
        inject: false,
      }),
    ],
  })
  .then((res) => {
    console.log(`Build complete`)
    console.log(res)
  })
  .catch(() => process.exit(1))
