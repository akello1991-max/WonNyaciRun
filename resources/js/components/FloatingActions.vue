<template>
<div class="float-actions">
  <a class="float-btn whatsapp" :href="whatsapp" target="_blank" rel="noreferrer" aria-label="WhatsApp"><span aria-hidden="true">&#9742;</span></a>
  <a class="float-btn x-btn" href="https://x.com/AkaoGloriah" target="_blank" rel="noreferrer" aria-label="X"><span aria-hidden="true">X</span></a>
  <RouterLink class="float-btn buy-btn" to="/pay" aria-label="Buy a kit">KIT</RouterLink>
</div>
</template>
<script setup>
const whatsapp='https://wa.me/256775384975?text=Hello%20Won%20Nyaci%20Run%202026%2C%20I%20want%20to%20get%20a%20kit.'
</script>
