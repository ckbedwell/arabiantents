import * as esbuild from "esbuild"

esbuild
  .build({
    entryPoints: [`src/main.tsx`],
    bundle: true,
    outfile: `dist/furnitureApp.js`,
    minify: true,
  }).then((res) => {
    console.log(`Build complete`)
    console.log(res)
  })
  .catch(() => process.exit(1))
