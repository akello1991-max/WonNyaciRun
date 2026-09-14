<template>
  <header class="nav-wrap">
    <nav class="nav container">
      <RouterLink to="/" class="brand" @click="mobile=false">
        <span class="brand-mark">WN</span><span><b>WON NYACI</b><small>RUN 2026</small></span>
      </RouterLink>
      <button class="menu-btn" @click="mobile=!mobile">☰</button>
      <div :class="['nav-links', { open: mobile }]">
        <RouterLink to="/#about" @click="mobile=false">About</RouterLink>
        <RouterLink to="/#impact" @click="mobile=false">Impact</RouterLink>
        <RouterLink to="/blog" @click="mobile=false">Stories</RouterLink>
        <a href="https://x.com/AkaoGloriah" target="_blank" rel="noreferrer" @click="mobile=false">X / Updates</a>
        <RouterLink to="/clans" @click="mobile=false">Clans</RouterLink>
        <RouterLink to="/practice" @click="mobile=false">Practice</RouterLink>
        <RouterLink to="/partners" @click="mobile=false">Partners</RouterLink>
        <RouterLink to="/contact" @click="mobile=false">Contact</RouterLink>
        <RouterLink to="/pay" class="kit-nav" @click="mobile=false">Get a Kit · 30K</RouterLink>
      </div>
    </nav>
  </header>
</template>
<script setup>
import { ref } from 'vue'
const mobile = ref(false)
</script>
