<template>
  <div class="app-shell">
    <SiteNav v-if="!isAdminRoute" />
    <main><router-view /></main>
    <FloatingActions v-if="!isAdminRoute" />
    <SiteFooter v-if="!isAdminRoute" />
  </div>
</template>
<script setup>
import { computed } from 'vue'
import { useRoute } from 'vue-router'
import SiteNav from './components/SiteNav.vue'
import SiteFooter from './components/SiteFooter.vue'
import FloatingActions from './components/FloatingActions.vue'
const route = useRoute()
const isAdminRoute = computed(() => route.path.startsWith('/admin'))
</script>

<style>
:root {
  --purple: #253b9f;
  --purple2: #315ac7;
  --deep: #071b4f;
  --ink: #102454;
  --muted: #526784;
  --cream: #f2fbff;
  --lime: #ffd52f;
  --orange: #e7353f;
  --line: #c9e6f4;
  --card-soft: #e7f7ff;
}

body { background: linear-gradient(180deg, #f2fbff 0%, #ffffff 100%) !important; }
.nav-wrap { background: rgba(242, 251, 255, 0.94) !important; border-bottom-color: rgba(37, 59, 159, 0.14) !important; }
.brand-mark { background: linear-gradient(135deg, #253b9f, #3d74dc) !important; }
.kit-nav, .btn-primary { background: linear-gradient(135deg, #e7353f, #f25a3f) !important; }
.runner-stage { background: radial-gradient(circle at 82% 16%, rgba(255, 213, 47, 0.32), transparent 16%), radial-gradient(circle at 18% 56%, rgba(231, 53, 63, 0.22), transparent 20%), linear-gradient(135deg, #071b4f 0%, #173c9a 45%, #47b9e8 100%) !important; }
.section.alt { background: linear-gradient(135deg, #e2f7ff 0%, #f4fbff 55%, #fff3c7 100%) !important; }
.kit-banner { background: linear-gradient(135deg, #071b4f 0%, #253b9f 55%, #e7353f 100%) !important; }
.footer, .admin-top { background: #071b4f !important; }
.admin-side { background: #102e78 !important; }
.admin-side a:hover, .admin-side a.router-link-active { background: linear-gradient(135deg, #e7353f, #f25a3f) !important; }
.float-actions{position:fixed!important;right:22px!important;bottom:22px!important;z-index:9999!important;display:flex!important;flex-direction:column!important;gap:12px!important;pointer-events:auto!important}.float-btn{display:grid!important;place-items:center!important;width:54px!important;height:54px!important;padding:0!important;border-radius:50%!important;border:2px solid rgba(255,255,255,.8)!important;color:#fff!important;font-family:Inter,ui-sans-serif,system-ui,sans-serif!important;font-size:11px!important;font-weight:900!important;letter-spacing:.06em!important;text-decoration:none!important;box-shadow:0 14px 28px rgba(7,27,79,.25)!important;transition:transform .2s ease,box-shadow .2s ease!important}.float-btn:hover{transform:translateY(-4px) scale(1.04)!important;box-shadow:0 20px 36px rgba(7,27,79,.34)!important}.float-btn.whatsapp{background:#159447!important}.float-btn.x-btn{background:#071b4f!important}.float-btn.buy-btn{background:#e7353f!important}.float-btn:focus-visible{outline:3px solid #ffd52f!important;outline-offset:3px!important}
.payment-wrap{position:relative;z-index:1}
@media(max-width:620px){.float-actions{right:12px!important;bottom:14px!important;gap:8px!important}.float-btn{width:48px!important;height:48px!important;font-size:10px!important}}
.payment-wrap{min-height:calc(100vh - 76px);padding:clamp(44px,7vw,92px) 0;background:linear-gradient(135deg,#e2f7ff 0%,#f8fdff 55%,#fff3c7 100%)}.payment-wrap .section-head{max-width:780px}.payment-wrap h1{font-size:clamp(2.4rem,5vw,5rem);color:#071b4f;letter-spacing:-.06em}.payment-grid{align-items:start;gap:28px}.payment-card{padding:28px;background:rgba(255,255,255,.92);border:1px solid #c9e6f4;box-shadow:0 24px 70px rgba(8,37,92,.13)}.payment-head h2{color:#253b9f}.payment-row{background:#fff;border:1px solid #c9e6f4;box-shadow:0 10px 24px rgba(8,37,92,.06)}.payment-toggle{color:#071b4f}.payment-details{background:#f2fbff;border-top-color:#c9e6f4}.copy-line{border-bottom-color:#c9e6f4;grid-template-columns:minmax(110px,180px) 1fr auto}.copy-btn{border:1px solid #b9dff0;background:#e2f7ff;color:#253b9f}.payment-side .culture-card{padding:30px;background:linear-gradient(145deg,#071b4f,#253b9f);color:#fff}.payment-side .culture-card h3,.payment-side .culture-card p{color:#fff}.clan-grid,.practice-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:24px}.clan-card,.practice-card{overflow:hidden;border:1px solid #c9e6f4;border-radius:26px;background:#fff;box-shadow:0 20px 55px rgba(8,37,92,.11)}.clan-card img{width:100%;height:210px;object-fit:cover;background:#e2f7ff}.clan-card-body,.practice-card{padding:24px}.clan-mark,.practice-type{display:inline-block;padding:7px 10px;border-radius:99px;background:#fff0a8;color:#071b4f;font-size:10px;letter-spacing:.16em;font-weight:900;text-transform:uppercase}.clan-card h2,.practice-card h2{margin:14px 0;color:#071b4f}.clan-card dl{display:grid;gap:12px;margin:18px 0}.clan-card dt{font-size:11px;color:#526784;text-transform:uppercase;letter-spacing:.1em}.clan-card dd{margin:4px 0 0;color:#253b9f;font-weight:800}.clan-card p,.practice-card p{color:#526784;line-height:1.7}.practice-card{min-height:250px;background:linear-gradient(145deg,#fff,#e2f7ff)}.practice-type{background:#d9f1ff;color:#253b9f}.empty-state{padding:50px;border-radius:26px;background:#fff;border:1px solid #c9e6f4;text-align:center}.empty-state h2{color:#071b4f}.empty-state p{color:#526784}@media(max-width:900px){.clan-grid,.practice-grid{grid-template-columns:repeat(2,minmax(0,1fr))}}@media(max-width:620px){.payment-wrap{padding:40px 0}.payment-card{padding:16px}.copy-line{grid-template-columns:1fr;gap:6px}.copy-line .copy-btn{width:max-content}.clan-grid,.practice-grid{grid-template-columns:1fr}.clan-card img{height:190px}}
.float-btn.x-btn{background:#000!important}.float-btn.x-btn span{color:#fff!important;font-size:22px!important;line-height:1}.float-btn.whatsapp span{color:#fff!important;font-size:25px!important;line-height:1;transform:rotate(-18deg)}
.float-btn.whatsapp{background:#fff!important;border-color:#19a866!important}.float-btn.whatsapp span{color:#19a866!important;font-size:25px!important;line-height:1;transform:rotate(-18deg)}.float-btn.x-btn{background:#000!important}.float-btn.x-btn span{color:#fff!important;font-size:22px!important;line-height:1}
.partner-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:22px}.partner-card{padding:26px;border:1px solid #c9e6f4;border-radius:24px;background:#fff;box-shadow:0 18px 48px rgba(8,37,92,.1)}.partner-logo{height:120px;display:grid;place-items:center;margin:-26px -26px 20px;background:linear-gradient(135deg,#e2f7ff,#fff3c7);color:#253b9f;font-size:2rem;font-weight:900}.partner-logo img{width:100%;height:100%;object-fit:contain}.partner-category{color:#159447;font-size:11px;font-weight:900;letter-spacing:.14em;text-transform:uppercase}.partner-card h2{margin:10px 0;color:#071b4f}.partner-card p{min-height:52px;color:#526784;line-height:1.65}.partner-card a{color:#e7353f;font-weight:800}.partner-cta{display:flex;align-items:center;justify-content:space-between;gap:24px;margin-top:56px;padding:32px;border-radius:28px;background:linear-gradient(135deg,#071b4f,#253b9f 65%,#e7353f);color:#fff}.partner-cta h2{margin:10px 0 6px}.partner-cta p{max-width:650px;color:rgba(255,255,255,.78)}
@media(max-width:900px){.partner-grid{grid-template-columns:repeat(2,minmax(0,1fr))}.partner-cta{display:block}}
@media(max-width:620px){.partner-grid{grid-template-columns:1fr}.partner-cta{padding:24px}.partner-cta .btn{width:100%;margin-top:12px}}
</style>
