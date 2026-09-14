<template>
  <div class="section partners-page"><div class="container"><div class="section-head"><span class="kicker">POWERING THE MOVEMENT</span><h1>Partners who keep us moving.</h1><p class="section-lead">We recognise the organisations, businesses and community champions who support every run, every year.</p></div><div v-if="partners.length" class="partner-grid"><article v-for="partner in partners" :key="partner.id" class="partner-card"><div class="partner-logo"><img v-if="partner.logo" :src="`/storage/${partner.logo}`" :alt="partner.name"><span v-else>{{ partner.name.slice(0, 2).toUpperCase() }}</span></div><span class="partner-category">{{ partner.category || 'Movement partner' }}</span><h2>{{ partner.name }}</h2><p>{{ partner.description }}</p><a v-if="partner.website_url" :href="partner.website_url" target="_blank" rel="noreferrer">Visit partner →</a></article></div><div v-else class="empty-state"><h2>Partner announcements are coming.</h2><p>We will keep recognising the people and organisations who support the movement.</p></div><div class="partner-cta"><div><span class="kicker">JOIN THE MOVEMENT</span><h2>Become a partner for the next run.</h2><p>Partnerships stay open beyond race day. Support community health, culture and inclusion throughout the year.</p></div><RouterLink to="/contact" class="btn btn-primary">Talk to the team →</RouterLink></div></div></div>
</template>
<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
const partners = ref([]), apiError = ref(false)
onMounted(async () => { try { const { data } = await axios.get('/api/partners'); if (!Array.isArray(data)) throw new Error(); partners.value = data } catch { apiError.value = true } })
</script>
