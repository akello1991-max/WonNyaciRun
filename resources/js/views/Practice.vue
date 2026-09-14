<template>
  <div class="section practice-page"><div class="container"><div class="section-head"><span class="kicker">PRACTICE WITH THE MOVEMENT</span><h1>Train together before race day.</h1><p class="section-lead">Use the official videos, audio warm-ups and aerobic guides posted by the run team.</p></div><div v-if="resources.length" class="practice-grid"><article v-for="resource in resources" :key="resource.id" class="practice-card"><div class="practice-type">{{ resource.type }}</div><h2>{{ resource.title }}</h2><p>{{ resource.description }}</p><a class="btn btn-primary" :href="resource.media_url" target="_blank" rel="noreferrer">Open {{ resource.type }} →</a></article></div><div v-else class="empty-state"><h2>Practice resources are coming.</h2><p>The admin team will publish videos and audio warm-ups here.</p></div></div></div>
</template>
<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
const resources = ref([])
onMounted(async () => { try { const { data } = await axios.get('/api/practice'); resources.value = Array.isArray(data) ? data : [] } catch { resources.value = [] } })
</script>
