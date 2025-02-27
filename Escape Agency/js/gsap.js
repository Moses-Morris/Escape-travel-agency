gsap.registerPlugin(ScrollTrigger);

        gsap.to(".slide-left", {
            x: 0,
            opacity: 1,
            duration: 1,
            scrollTrigger: {
                trigger: ".slide-left",
                start: "top 80%",
                toggleActions: "play none none none"
            }
        });

        gsap.to(".slide-right", {
            x: 0,
            opacity: 1,
            duration: 1,
            scrollTrigger: {
                trigger: ".slide-right",
                start: "top 80%",
                toggleActions: "play none none none"
            }
        });

        gsap.to(".slide-up", {
            y: 0,
            opacity: 1,
            duration: 1,
            scrollTrigger: {
                trigger: ".slide-up",
                start: "top 80%",
                toggleActions: "play none none none"
            }
        });

        gsap.to(".slide-down", {
            y: 0,
            opacity: 1,
            duration: 1,
            scrollTrigger: {
                trigger: ".slide-down",
                start: "top 80%",
                toggleActions: "play none none none"
            }
        });