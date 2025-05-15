document.addEventListener("DOMContentLoaded", () => {
    const canvas = document.getElementById("particleCanvas")
    const ctx = canvas.getContext("2d")
  
    // Mouse tracking
    const mousePosition = { x: 0, y: 0 }
    let isTouching = false
    let isMobile = false
  
    // Particles array
    let particles = []
    let textImageData = null
    let animationFrameId = null
  
    // Initialize canvas
    function initCanvas() {
      canvas.width = window.innerWidth
      canvas.height = window.innerHeight
      isMobile = window.innerWidth < 768
    }
  
    // Create text image
    function createTextImage() {
      if (!ctx || !canvas) return 0
  
      // Clear the canvas first
      ctx.clearRect(0, 0, canvas.width, canvas.height)
  
      // Set text properties
      const fontSize = isMobile ? 32 : 48
      const personalNameFontSize = isMobile ? 28 : 42
  
      // Measure text dimensions
      ctx.font = `bold ${fontSize}px Inter, system-ui, sans-serif`
      const appNameWidth = ctx.measureText("YallaBina").width
  
      ctx.font = `${personalNameFontSize}px Inter, system-ui, sans-serif`
      const personalNameWidth = ctx.measureText("Driss Nafii").width
  
      const spacing = isMobile ? 20 : 40
      const totalWidth = appNameWidth + personalNameWidth + spacing
  
      // Position text in center
      const startX = (canvas.width - totalWidth) / 2
      const startY = canvas.height / 2
  
      // Draw app name
      ctx.fillStyle = "white"
      ctx.font = `bold ${fontSize}px Inter, system-ui, sans-serif`
      ctx.fillText("YallaBina", startX, startY)
  
      // Draw personal name
      ctx.font = `${personalNameFontSize}px Inter, system-ui, sans-serif`
      ctx.fillText("Driss Nafii", startX + appNameWidth + spacing, startY)
  
      // Capture the pixel data
      textImageData = ctx.getImageData(0, 0, canvas.width, canvas.height)
  
      // Clear the canvas again to prepare for animation
      ctx.clearRect(0, 0, canvas.width, canvas.height)
  
      return {
        fontSize,
        appNameWidth,
        spacing,
        startX,
        centerY: startY,
      }
    }
  
    // Create a particle
    function createParticle(textMetrics) {
      if (!ctx || !canvas || !textImageData) return null
  
      const data = textImageData.data
      const { fontSize, appNameWidth, spacing, startX, centerY } = textMetrics
  
      // Measure text dimensions for personal name
      ctx.font = `${isMobile ? 28 : 42}px Inter, system-ui, sans-serif`
      const personalNameWidth = ctx.measureText("Driss Nafii").width
      const totalWidth = appNameWidth + personalNameWidth + spacing
  
      // Try to find a pixel that's part of the text
      for (let attempt = 0; attempt < 100; attempt++) {
        // Focus sampling around the text area
        const x = Math.floor(startX - 10 + Math.random() * (totalWidth + 20))
        const y = Math.floor(centerY - fontSize - 10 + Math.random() * (fontSize * 2 + 20))
  
        // Check if this pixel is part of the text (has alpha > 0)
        if (x >= 0 && y >= 0 && x < canvas.width && y < canvas.height && data[(y * canvas.width + x) * 4 + 3] > 128) {
          // Determine which text the particle belongs to
          const isPersonalName = x >= startX + appNameWidth + spacing / 2
  
          return {
            x: x,
            y: y,
            baseX: x,
            baseY: y,
            size: Math.random() * 1.5 + 0.5, // Slightly larger particles
            color: "white",
            scatteredColor: isPersonalName ? "#FF6B6B" : "#4ECDC4",
            isPersonalName: isPersonalName,
            life: Math.random() * 100 + 50,
          }
        }
      }
  
      return null
    }
  
    // Create initial particles
    function createInitialParticles(textMetrics) {
      const baseParticleCount = 7000 // Base count for particle density
      const particleCount = Math.floor(baseParticleCount * Math.sqrt((canvas.width * canvas.height) / (1920 * 1080)))
  
      particles = []
      for (let i = 0; i < particleCount; i++) {
        const particle = createParticle(textMetrics)
        if (particle) particles.push(particle)
      }
    }
  
    // Animation loop
    function animate(textMetrics) {
      if (!ctx || !canvas) return
  
      ctx.clearRect(0, 0, canvas.width, canvas.height)
      ctx.fillStyle = "black"
      ctx.fillRect(0, 0, canvas.width, canvas.height)
  
      const maxDistance = 180 // Interaction distance
  
      for (let i = 0; i < particles.length; i++) {
        const p = particles[i]
        const dx = mousePosition.x - p.x
        const dy = mousePosition.y - p.y
        const distance = Math.sqrt(dx * dx + dy * dy)
  
        if (distance < maxDistance && (isTouching || !("ontouchstart" in window))) {
          const force = (maxDistance - distance) / maxDistance
          const angle = Math.atan2(dy, dx)
          const moveX = Math.cos(angle) * force * 80 // Increased force
          const moveY = Math.sin(angle) * force * 80
          p.x = p.baseX - moveX
          p.y = p.baseY - moveY
  
          ctx.fillStyle = p.scatteredColor
        } else {
          p.x += (p.baseX - p.x) * 0.1
          p.y += (p.baseY - p.y) * 0.1
          ctx.fillStyle = "white"
        }
  
        ctx.fillRect(p.x, p.y, p.size, p.size)
  
        p.life--
        if (p.life <= 0) {
          const newParticle = createParticle(textMetrics)
          if (newParticle) {
            particles[i] = newParticle
          } else {
            particles.splice(i, 1)
            i--
          }
        }
      }
  
      // Ensure we maintain enough particles
      const baseParticleCount = 7000
      const targetParticleCount = Math.floor(
        baseParticleCount * Math.sqrt((canvas.width * canvas.height) / (1920 * 1080)),
      )
  
      // Add more particles if needed
      while (particles.length < targetParticleCount) {
        const newParticle = createParticle(textMetrics)
        if (newParticle) particles.push(newParticle)
        else break // Stop if we can't create more particles
      }
  
      animationFrameId = requestAnimationFrame(() => animate(textMetrics))
    }
  
    // Event handlers
    function handleMouseMove(e) {
      mousePosition.x = e.clientX
      mousePosition.y = e.clientY
    }
  
    function handleTouchMove(e) {
      if (e.touches.length > 0) {
        e.preventDefault()
        mousePosition.x = e.touches[0].clientX
        mousePosition.y = e.touches[0].clientY
      }
    }
  
    function handleTouchStart() {
      isTouching = true
    }
  
    function handleTouchEnd() {
      isTouching = false
      mousePosition.x = 0
      mousePosition.y = 0
    }
  
    function handleMouseLeave() {
      if (!("ontouchstart" in window)) {
        mousePosition.x = 0
        mousePosition.y = 0
      }
    }
  
    function handleResize() {
      initCanvas()
      const textMetrics = createTextImage()
      particles = []
      createInitialParticles(textMetrics)
    }
  
    // Initialize and start animation
    function init() {
      initCanvas()
      const textMetrics = createTextImage()
      createInitialParticles(textMetrics)
      animate(textMetrics)
  
      // Add event listeners
      window.addEventListener("resize", handleResize)
      canvas.addEventListener("mousemove", handleMouseMove)
      canvas.addEventListener("touchmove", handleTouchMove, { passive: false })
      canvas.addEventListener("mouseleave", handleMouseLeave)
      canvas.addEventListener("touchstart", handleTouchStart)
      canvas.addEventListener("touchend", handleTouchEnd)
    }
  
    // Start the animation
    init()
  
    // Cleanup function (not used in this context but good practice)
    function cleanup() {
      window.removeEventListener("resize", handleResize)
      canvas.removeEventListener("mousemove", handleMouseMove)
      canvas.removeEventListener("touchmove", handleTouchMove)
      canvas.removeEventListener("mouseleave", handleMouseLeave)
      canvas.removeEventListener("touchstart", handleTouchStart)
      canvas.removeEventListener("touchend", handleTouchEnd)
      cancelAnimationFrame(animationFrameId)
    }
  })
  