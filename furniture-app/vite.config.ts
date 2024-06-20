import path from "path"
import { defineConfig } from "vite"
import react from "@vitejs/plugin-react"

// https://vitejs.dev/config/
export default defineConfig({
  resolve: {
    alias: {
      "~": path.resolve(__dirname, `src`),
    },
  },
  server: {
    open: true,
  },
  build: {
    lib: {
      entry: path.resolve(__dirname, `src/main.tsx`),
      name: `furnitureApp`,
      fileName: (format) => `furniture-app.${format}.js`,
    },
  },
  plugins: [react()],
})
