import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import path from 'node:path'

export default defineConfig(({ mode }) => {
  const isNetlify = mode === 'netlify'

  return {
  plugins: [vue()],
  resolve: { alias: { '@': path.resolve(__dirname, 'resources/js') } },
  server: { host: '0.0.0.0', port: 5173, strictPort: true },
  publicDir: 'public',
  build: {
    outDir: isNetlify ? 'dist' : 'public/build',
    emptyOutDir: true,
    manifest: isNetlify ? false : 'manifest.json',
    rollupOptions: {
      input: isNetlify ? path.resolve(__dirname, 'index.html') : {
        'resources/css/app.css': path.resolve(__dirname, 'resources/css/app.css'),
        'resources/js/main.js': path.resolve(__dirname, 'resources/js/main.js')
      }
    }
  }
  }
})
