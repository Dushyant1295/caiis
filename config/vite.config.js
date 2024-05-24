import { defineConfig } from 'vite'
import liveReload from 'vite-plugin-live-reload'
const { resolve } = require('path')

export default defineConfig({
  plugins: [
    liveReload(__dirname + '../../**/*.twig')
  ],
  root: '',
  base: process.env.NODE_ENV === 'development'
    ? '/'
    : '/dist/',
  build: {
    outDir: resolve(__dirname, './dist'),
    emptyOutDir: true,
    manifest: false,
    target: 'es2018',
    rollupOptions: {
      input: {
        main: resolve(__dirname + 'config/main.js')
      },
      output: {
        entryFileNames: `assets/[name].js`,
        chunkFileNames: `assets/[name].js`,
        assetFileNames: `assets/[name].[ext]`
      }
    },
    minify: true,
    write: true
  },
  server: {
    cors: true,
    strictPort: true,
    port: 3000,
    https: false,
    hmr: {
      host: 'localhost'
    },
  },
  resolve: {}
})
 