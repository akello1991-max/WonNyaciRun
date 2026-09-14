<template>
  <section class="runner-stage">
    <div class="sun-orb"></div>
    <div class="cloud c1"></div>
    <div class="cloud c2"></div>
    <div class="track-lines"><i></i><i></i><i></i><i></i></div>

    <div class="container hero-inner">
      <div class="hero-copy-wrap">
        <div class="hero-copy">
          <span class="eyebrow">LANGO CULTURAL INSTITUTION · TEKWARO A'LANGO</span>
          <h2>Run for a future where <strong>everybody belongs.</strong></h2>
          <p>
            One run. One culture. One movement — turning every kit into practical support for people living with disabilities in Lango.
          </p>

          <div class="hero-actions">
            <RouterLink to="/pay" class="btn btn-primary">Get your kit · UGX 30K <span>→</span></RouterLink>
            <RouterLink to="/#about" class="btn btn-secondary">See the story</RouterLink>
          </div>
        </div>
      </div>

      <div class="countdown-panel">
        <div class="countdown-label">Event countdown</div>
        <div class="countdown-grid">
          <div class="count-box"><strong>{{ countdown.days }}</strong><span>Days</span></div>
          <div class="count-box"><strong>{{ countdown.hours }}</strong><span>Hours</span></div>
          <div class="count-box"><strong>{{ countdown.minutes }}</strong><span>Minutes</span></div>
          <div class="count-box"><strong>{{ countdown.seconds }}</strong><span>Seconds</span></div>
        </div>
        <div class="countdown-meta">
          <div><span>Starts</span><strong>24 Oct 2026</strong></div>
          <div><span>Venue</span><strong>Old Akii Bua Stadium</strong></div>
        </div>
      </div>
    </div>

    <div class="runner-scene" ref="sceneHost" aria-label="Interactive 3D runner">
      <div class="scene-loading" v-if="sceneLoading">Loading runner...</div>
    </div>

    <div :class="['formed-title', { show: showTitle }]" aria-live="polite">
      <div class="mini-flag">✦</div>
      <h1>WON NYACI RUN <em>2026</em></h1>
      <p>RUNNING FOR OUR CULTURE · OUR HEALTH · OUR FUTURE</p>
    </div>

    <div class="finish"><span>FINISH</span><div class="finish-flag"></div><div class="finish-post"></div></div>

    <div class="date-ribbon"><b>24</b><span>OCT<br><strong>2026</strong></span></div>
  </section>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue'
import * as THREE from 'three'

const sceneHost = ref(null)
const sceneLoading = ref(true)
const showTitle = ref(false)
const countdown = ref({ days: 0, hours: 0, minutes: 0, seconds: 0 })
const eventDate = new Date('2026-10-24T06:00:00+03:00')
let timer = null
let animationFrame = null
let resizeObserver = null

const updateCountdown = () => {
  const diff = Math.max(0, eventDate.getTime() - Date.now())
  const totalSeconds = Math.floor(diff / 1000)
  const days = Math.floor(totalSeconds / 86400)
  const hours = Math.floor((totalSeconds % 86400) / 3600)
  const minutes = Math.floor((totalSeconds % 3600) / 60)
  const seconds = totalSeconds % 60

  countdown.value = { days, hours, minutes, seconds }
}

onMounted(() => {
  updateCountdown()
  timer = setInterval(updateCountdown, 1000)
  setupRunnerScene()
})

onBeforeUnmount(() => {
  if (timer) clearInterval(timer)
  if (animationFrame) cancelAnimationFrame(animationFrame)
  if (resizeObserver) resizeObserver.disconnect()
})

const setupRunnerScene = () => {
  const host = sceneHost.value
  if (!host) return

  const scene = new THREE.Scene()
  const camera = new THREE.PerspectiveCamera(34, 1, 0.1, 100)
  camera.position.set(3.9, 2.6, 6.4)
  camera.lookAt(0, 1.4, 0)

  const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true })
  renderer.setPixelRatio(Math.min(window.devicePixelRatio, 1.75))
  renderer.setClearColor(0x000000, 0)
  host.appendChild(renderer.domElement)

  scene.add(new THREE.HemisphereLight(0xf8f0ff, 0x24103d, 2.2))
  const keyLight = new THREE.DirectionalLight(0xffffff, 3.4)
  keyLight.position.set(3, 6, 5)
  scene.add(keyLight)

  const ground = new THREE.Mesh(
    new THREE.CylinderGeometry(2.25, 2.7, 0.18, 64),
    new THREE.MeshStandardMaterial({ color: 0x2a124e, roughness: 0.9 })
  )
  ground.position.y = -0.08
  scene.add(ground)

  const runner = new THREE.Group()
  runner.position.y = 0.08
  scene.add(runner)

  const skin = new THREE.MeshStandardMaterial({ color: 0x8f573c, roughness: 0.7 })
  const vest = new THREE.MeshStandardMaterial({ color: 0xcfff42, roughness: 0.55 })
  const shorts = new THREE.MeshStandardMaterial({ color: 0x241237, roughness: 0.8 })
  const shoe = new THREE.MeshStandardMaterial({ color: 0xffffff, roughness: 0.45 })
  const limb = (radius, length, material) => new THREE.Mesh(new THREE.CapsuleGeometry(radius, length, 6, 12), material)

  const head = new THREE.Mesh(new THREE.SphereGeometry(0.28, 20, 16), skin)
  head.position.y = 2.35
  runner.add(head)
  const torso = new THREE.Mesh(new THREE.CapsuleGeometry(0.34, 0.62, 6, 16), vest)
  torso.position.y = 1.65
  runner.add(torso)

  const hip = new THREE.Mesh(new THREE.BoxGeometry(0.52, 0.24, 0.34), shorts)
  hip.position.y = 1.18
  runner.add(hip)

  const leftArm = new THREE.Group()
  const rightArm = new THREE.Group()
  const leftLeg = new THREE.Group()
  const rightLeg = new THREE.Group()
  leftArm.position.set(-0.34, 1.9, 0)
  rightArm.position.set(0.34, 1.9, 0)
  leftLeg.position.set(-0.18, 1.12, 0)
  rightLeg.position.set(0.18, 1.12, 0)
  leftArm.add(limb(0.11, 0.48, skin))
  rightArm.add(limb(0.11, 0.48, skin))
  leftLeg.add(limb(0.14, 0.58, skin))
  rightLeg.add(limb(0.14, 0.58, skin))
  leftArm.children[0].position.y = -0.3
  rightArm.children[0].position.y = -0.3
  leftLeg.children[0].position.y = -0.34
  rightLeg.children[0].position.y = -0.34
  runner.add(leftArm, rightArm, leftLeg, rightLeg)

  const leftShoe = new THREE.Mesh(new THREE.BoxGeometry(0.3, 0.14, 0.58), shoe)
  const rightShoe = leftShoe.clone()
  leftShoe.position.set(-0.2, 0.43, 0.16)
  rightShoe.position.set(0.2, 0.43, 0.16)
  runner.add(leftShoe, rightShoe)

  const particlePositions = new Float32Array(72)
  for (let i = 0; i < particlePositions.length; i += 3) {
    particlePositions[i] = (Math.random() - 0.5) * 1.3
    particlePositions[i + 1] = 0.7 + Math.random() * 1.8
    particlePositions[i + 2] = (Math.random() - 0.5) * 0.5
  }
  const particleGeometry = new THREE.BufferGeometry()
  particleGeometry.setAttribute('position', new THREE.BufferAttribute(particlePositions, 3))
  const particleMaterial = new THREE.PointsMaterial({ color: 0xd9ff58, size: 0.1, transparent: true, opacity: 0 })
  const particles = new THREE.Points(particleGeometry, particleMaterial)
  particles.visible = false
  scene.add(particles)

  const resize = () => {
    const width = Math.max(host.clientWidth, 1)
    const height = Math.max(host.clientHeight, 1)
    camera.aspect = width / height
    camera.updateProjectionMatrix()
    renderer.setSize(width, height, false)
  }
  resizeObserver = new ResizeObserver(resize)
  resizeObserver.observe(host)
  resize()
  sceneLoading.value = false

  const clock = new THREE.Clock()
  const animate = () => {
    const elapsed = clock.getElapsedTime()
    const cycle = elapsed % 12
    const stride = Math.sin(elapsed * 7) * 0.58
    leftArm.rotation.z = -0.35 + stride
    rightArm.rotation.z = 0.35 - stride
    leftLeg.rotation.z = stride * 0.78
    rightLeg.rotation.z = -stride * 0.78
    const approach = Math.min(cycle / 4.5, 1)
    runner.rotation.y = Math.sin(elapsed * 0.45) * 0.12
    runner.position.x = -2.1 + approach * 2.1
    runner.visible = cycle < 4.9 || cycle > 10.8

    const burstProgress = Math.min(Math.max((cycle - 4.5) / 1.8, 0), 1)
    particles.visible = burstProgress > 0 && burstProgress < 1
    particleMaterial.opacity = Math.sin(burstProgress * Math.PI) * 0.95
    particles.scale.setScalar(1 + burstProgress * 2.4)
    showTitle.value = cycle >= 6.2 && cycle < 10.8
    renderer.render(scene, camera)
    animationFrame = requestAnimationFrame(animate)
  }
  animate()
}
</script>
