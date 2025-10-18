(function() {
    document.addEventListener('DOMContentLoaded', function() {
            // Efek salju pada kursor
            document.addEventListener('mousemove', function(e) {
                for (let i = 0; i < 2; i++) { // spawn 2 snowflakes per move for density
                    const snow = document.createElement('div');
                    const size = Math.random() * 6 + 4;
                    snow.style.position = 'fixed';
                    snow.style.left = (e.clientX + Math.random()*12-6) + 'px';
                    snow.style.top = (e.clientY + Math.random()*8-4) + 'px';
                    snow.style.width = size + 'px';
                    snow.style.height = size + 'px';
                    snow.style.borderRadius = '50%';
                    snow.style.background = 'white';
                    snow.style.opacity = (Math.random()*0.4+0.6).toString();
                    snow.style.pointerEvents = 'none';
                    snow.style.zIndex = '9999';
                    snow.style.boxShadow = '0 0 8px #e0e7ff';
                    snow.style.transition = 'transform 1.2s linear, opacity 1.2s linear';
                    document.body.appendChild(snow);

                    // Animate falling
                    setTimeout(() => {
                        snow.style.transform = `translateY(${40+Math.random()*40}px) scale(${0.7+Math.random()*0.5})`;
                        snow.style.opacity = '0';
                    }, 10);
                    // Remove after animation
                    setTimeout(() => snow.remove(), 1300);
                }
            });
    });
})();
