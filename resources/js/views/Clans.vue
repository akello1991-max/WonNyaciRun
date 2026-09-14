<template>
  <div class="section clans-page"><div class="container"><div class="section-head"><span class="kicker">THE CLANS OF LANGO</span><h1>Meet the clans running together.</h1><p class="section-lead">Discover the people, leaders and places that make Lango a living movement.</p></div><div v-if="clans.length" class="clan-grid"><article v-for="clan in clans" :key="clan.id" class="clan-card"><img v-if="clan.image" :src="`/storage/${clan.image}`" :alt="clan.name"><div class="clan-card-body"><span class="clan-mark">CLAN</span><h2>{{ clan.name }}</h2><dl><div><dt>Awitong</dt><dd>{{ clan.awitong || 'To be announced' }}</dd></div><div><dt>Majority found in</dt><dd>{{ clan.majority_location || 'Lango' }}</dd></div></dl><p>{{ clan.description }}</p></div></article></div><div v-else class="empty-state"><h2>Clan profiles are coming.</h2><p>The admin team will publish clan profiles here.</p></div></div></div>
</template>
<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
const clans = ref([])
onMounted(async () => { clans.value = (await axios.get('/api/clans')).data })
</script>
