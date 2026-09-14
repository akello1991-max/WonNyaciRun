<template>
  <div class="payment-wrap">
    <div class="container">
      <div class="section-head">
        <span class="kicker">GET YOUR KIT</span>
        <h1>Support the run. Secure your kit.</h1>
        <p class="section-lead">
          Standard kit: <b>UGX 30,000</b>. Corporate T-shirts: <b>UGX 50,000</b>.
          Choose a payment method below and use your full name as the payment reference.
        </p>
      </div>

      <div class="payment-grid">
        <div class="payment-card">
          <div class="payment-head">
            <h2>PAY FOR YOUR KIT</h2>
            <p>Official payment instructions</p>
          </div>

          <div v-for="(p, i) in payments" :key="p.id" class="payment-row">
            <button class="payment-toggle" @click="open = open === i ? -1 : i">
              <span>{{ p.label }}</span>
              <span>{{ open === i ? '−' : '+' }}</span>
            </button>

            <div v-if="open === i" class="payment-details">
              <div v-for="(value, key) in p.details" :key="key" class="copy-line">
                <strong>{{ pretty(key) }}:</strong>
                <span>{{ value }}</span>
                <button v-if="isCopyable(value)" class="copy-btn" @click="copy(value)">Copy</button>
              </div>

              <p v-if="p.method === 'mtn'" class="notice">
                MTN menu shown in the supplied payment reference: dial <b>*165*4*4#</b>,
                select the merchant option and use the reference/name requested.
              </p>
            </div>
          </div>

          <div class="payment-row">
            <button class="payment-toggle" @click="open = open === 99 ? -1 : 99">
              <span>Card payment</span>
              <span>{{ open === 99 ? '−' : '+' }}</span>
            </button>

            <div v-if="open === 99" class="payment-details">
              <p>
                Card checkout is prepared as a provider-ready slot. Add your preferred payment gateway
                credentials in Laravel before accepting live card payments.
              </p>
              <button class="btn btn-primary" @click="demoCard = true">Open secure checkout</button>
            </div>
          </div>
        </div>

        <div class="payment-side">
          <div class="culture-card" style="margin-top: 20px">
            <h3>Before you pay</h3>
            <p>After payment, keep your transaction receipt. The run team can use your name/reference to confirm your kit.</p>
            <p><b>Need help?</b> WhatsApp the run team from the floating button or contact the organisers.</p>
          </div>
        </div>
      </div>
    </div>

    <div v-if="demoCard" class="modal">
      <div class="modal-card">
        <button class="close" @click="demoCard = false">×</button>
        <h3>Secure checkout ready</h3>
        <p>Connect your payment provider credentials in Laravel before enabling live card processing.</p>
        <button class="btn btn-primary" @click="demoCard = false">Close</button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const payments = ref([])
const open = ref(0)
const demoCard = ref(false)

const pretty = (key) => key.replaceAll('_', ' ').replace(/\b\w/g, (m) => m.toUpperCase())
const isCopyable = (value) => typeof value === 'string' && value.length < 80

const copy = async (value) => {
  try {
    await navigator.clipboard.writeText(value)
    alert('Copied')
  } catch {}
}

onMounted(async () => {
  const { data } = await axios.get('/api/payments')
  payments.value = data
})
</script>

<style scoped>
.modal {
  position: fixed;
  inset: 0;
  background: rgba(16, 4, 27, 0.72);
  display: grid;
  place-items: center;
  z-index: 100;
}

.modal-card {
  position: relative;
  background: white;
  padding: 35px;
  border-radius: 25px;
  width: min(480px, calc(100% - 30px));
  box-shadow: 0 30px 80px rgba(0, 0, 0, 0.35);
}

.close {
  position: absolute;
  right: 15px;
  top: 12px;
  border: 0;
  background: none;
  font-size: 28px;
  cursor: pointer;
}
</style>
